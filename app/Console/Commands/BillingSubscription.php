<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use DB;
use Log;

class BillingSubscription extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'billing:subscription';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate the billing for subscriptions';

    /**
     * Create a new command instance.
     *
     * BillingSubscription constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Log::info('Billing for subscriptions started : ' .Carbon::now());
        // get users with user type client 
        $allSubscriptions = DB::table('users as u')
                ->leftJoin('cc_system_subscription_pricelist as spricelist', 'spricelist.user_role_id', '=', 'u.role_id')
                ->select('u.id', 'u.name', 'u.email', 'u.user_type', 'u.balance', 'u.active_from', 'u.active_to',
                    'u.role_id', 'u.last_billing_date', 'u.is_subscription_expired', 'spricelist.fee',
                    'spricelist.period_length', 'spricelist.period_name',
                    'spricelist.valid_from', 'spricelist.valid_to')
                ->whereNull('u.deleted_at')
                ->where(['u.user_type'=>'Client'])
                ->get();

        // validate the subscription expireation
        // bill the subscription fee from last billed date to current time
        foreach($allSubscriptions as $subscription)
        {

            $isExpired = 0;    
            if (!empty($subscription->active_to)) {

                // validate the subscription expireation
                $currentTime = strtotime("now");
                $subscriptionActiveTo = strtotime($subscription->active_to);

                if ($currentTime > $subscriptionActiveTo) {
                    //subscription is expired
                    $isExpired = 1;
                    DB::table('users')
                     ->where('id', $subscription->id)
                     ->update(['is_subscription_expired' => 1]);
                }      

                //if expired
                if ($isExpired == 1) {
                    if (!empty($subscription->active_from)) {
                        // bill the subscription fee from last billed date to current time
                        $lastBillDateTimeStamp = strtotime($subscription->last_billing_date);
                        if ($lastBillDateTimeStamp == 0) {
                            $lastBillDate = date('Y-m-d H:i:s', strtotime($subscription->active_from));
                            $lastBillDateTimeStamp = strtotime($subscription->active_from);
                        } else {
                            //calculate the subscription billing fee
                            $lastBill = date_create(date('Y-m-d H:i:s', $lastBillDateTimeStamp));
                            $current = date_create(date('Y-m-d H:i:s', $currentTime));
                            $diff = date_diff($lastBill, $current);
                            $hours = isset($diff->h) ? $diff->h : 0;
                            $days = isset($diff->d) ? $diff->d : 0;
                            $weeks = isset($diff->w) ? $diff->w : 0;
                            $months = isset($diff->m) ? $diff->m : 0;
                            $years = isset($diff->y) ? $diff->y : 0;
                            $subscriptionTime = 1;
                            $nextPayment = Carbon::now()->addDay();
                            if ($subscription->fee > 0)
                            {
                                if(!empty($subscription->period_name))
                                {
                                    if($subscription->period_name == 'hour')
                                    {
                                        $nextPayment = Carbon::now()->addHour();
                                        $subscriptionTime = $hours;
                                    }
                                    else if($subscription->period_name == 'day')
                                    {
                                        $nextPayment = Carbon::now()->addDay();
                                        $subscriptionTime = $days;
                                    }
                                    else if($subscription->period_name == 'week')
                                    {
                                        $nextPayment = Carbon::now()->addWeek();
                                        $subscriptionTime = $weeks;
                                    }
                                    else if($subscription->period_name == 'month')
                                    {
                                        $nextPayment = Carbon::now()->addMonth();
                                        $subscriptionTime = $months;
                                    }
                                    else if($subscription->period_name == 'year')
                                    {
                                        $nextPayment = Carbon::now()->addYear();
                                        $subscriptionTime = $years;
                                    }

                                    $subscriptionFee = $subscription->fee;
                                    $priceGap = $subscription->fee;     

                                    //apply to subscription price calculation algorithm
                                    //P+((T-1)*G) = billing amount
                                    $lateTime = ($subscriptionTime > 1) ? $subscriptionTime-1 : $subscriptionTime;
                                    $billingAmount = $subscriptionFee + ($lateTime * $priceGap);
                                    $billingAmount = number_format($billingAmount, 2);
                                    //update the user table last billing date
                                    $lastBillDate = date('Y-m-d H:i:s', $currentTime);
                                    DB::table('users')
                                     ->where('id', $subscription->id)
                                     ->update([
                                         'last_billing_date' => $lastBillDate,
                                         'active_to' => $nextPayment,
                                         'active_from' => Carbon::now(),
                                     ]);

                                    //add the transaction record
                                    //order id needs to verify from where it take 
                                    DB::table('cc_system_transactions')->insert(
                                      [
                                        'payer_id' => $subscription->id, 
                                        'receiver_id' => 0,
                                        'transaction_description' => 'Billed amount from '.$lastBill->format('y-m-d').' to '.$current->format('y-m-d').' time period on '.$subscription->period_length.' basis.',
                                        'amount' => $billingAmount,
                                        'transaction_date' => $lastBillDate,
                                        'created_at' => $lastBillDate
                                      ]
                                    );

                                    //Update user balance
                                    $user = DB::table('users')->where('id', $subscription->id)->first();
                                    if (isset($user->balance) && !empty($user->balance)) {
                                        $balance = $user->balance;
                                    } else {
                                        $balance = 0;
                                    }
                                    $balance = $balance - $billingAmount;
                                    DB::table('users')->where('id', $subscription->id)->update(['balance' => $balance]);

                                    echo 'add the transaction record' . PHP_EOL;
                                
                                }
                                else
                                {
                                    //subscription period length not defined
                                    echo 'subscription period length not defined' . PHP_EOL;
                                    Log::warning('BillingSubscription user id : '.$subscription->id.' subscription period length not defined');
                                }
                            }
                            else
                            {
                                //echo subscription fee not define
                                echo 'subscription fee not define' . PHP_EOL;
                                Log::warning('BillingSubscription user id : '.$subscription->id.' subscription fee not defined');
                            }
                            
                        }
                    }
                    else
                    {
                        //echo subscription active from date is empty
                        echo 'subscription active from date is empty' . PHP_EOL;
                        Log::warning('BillingSubscription user id : '.$subscription->id.' subscription active from date is empty');
                    }
                } else {
                    echo 'subscription not expired' . PHP_EOL;
                }
            } else {

                //If subscription active to date is empty, update as today
                DB::table('users')
                    ->where('id', $subscription->id)
                    ->update([
                        'active_to' => Carbon::now(),
                        'active_from' => Carbon::yesterday(),
                        'last_billing_date' => Carbon::yesterday(),
                        ]);

                echo 'subscription active to time is empty' . PHP_EOL;
                Log::warning('BillingSubscription user id : '.$subscription->id.' subscription active to time is empty');
            }
                        
        }
        Log::info('Billing for subscriptions end : ' .Carbon::now());
    }
}
