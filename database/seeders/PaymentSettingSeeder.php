<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payment_settings = array(
            array(
                "id" => 1,
                "key" => "paypal_status",
                "value" => "active",
                "created_at" => "2024-03-08 03:10:28",
                "updated_at" => "2024-03-08 08:16:36",
            ),
            array(
                "id" => 2,
                "key" => "paypal_account_mode",
                "value" => "sandbox",
                "created_at" => "2024-03-08 03:10:28",
                "updated_at" => "2024-03-08 03:10:28",
            ),
            array(
                "id" => 3,
                "key" => "paypal_country",
                "value" => "US",
                "created_at" => "2024-03-08 03:10:28",
                "updated_at" => "2024-03-08 08:17:07",
            ),
            array(
                "id" => 4,
                "key" => "paypal_currency_name",
                "value" => "USD",
                "created_at" => "2024-03-08 03:10:28",
                "updated_at" => "2024-03-10 02:13:44",
            ),
            array(
                "id" => 5,
                "key" => "paypal_currency_rate",
                "value" => "1",
                "created_at" => "2024-03-08 03:10:28",
                "updated_at" => "2024-03-10 02:13:44",
            ),
            array(
                "id" => 6,
                "key" => "paypal_client_id",
                "value" => "Aa8Z_EeK8DDnCBUkXlTTNb053vfjmcL-feMicjo6qqYwZHqiUXZI9Nj65mtfLcy5ZH2Io2IRVholwqgx",
                "created_at" => "2024-03-08 03:10:28",
                "updated_at" => "2024-03-08 11:19:08",
            ),
            array(
                "id" => 7,
                "key" => "paypal_secret_key",
                "value" => "EMsDFB6Q44V0wgAdZzwDWaadX5CWKL9JxnUezkuQarhaWmeMBm6VspqBIpRH277y7SG2TzyxImGv8uup",
                "created_at" => "2024-03-08 03:10:28",
                "updated_at" => "2024-03-10 02:45:05",
            ),
            array(
                "id" => 8,
                "key" => "paypal_app_id",
                "value" => "App_id",
                "created_at" => "2024-03-08 03:10:28",
                "updated_at" => "2024-03-08 03:10:28",
            ),
            array(
                "id" => 9,
                "key" => "stripe_status",
                "value" => "active",
                "created_at" => "2024-03-10 13:40:55",
                "updated_at" => "2024-03-10 13:40:55",
            ),
            array(
                "id" => 10,
                "key" => "stripe_country",
                "value" => "US",
                "created_at" => "2024-03-10 13:40:55",
                "updated_at" => "2024-03-10 13:40:55",
            ),
            array(
                "id" => 11,
                "key" => "stripe_currency_name",
                "value" => "USD",
                "created_at" => "2024-03-10 13:40:55",
                "updated_at" => "2024-03-10 13:40:55",
            ),
            array(
                "id" => 12,
                "key" => "stripe_currency_rate",
                "value" => "1",
                "created_at" => "2024-03-10 13:40:55",
                "updated_at" => "2024-03-10 13:40:55",
            ),
            array(
                "id" => 13,
                "key" => "stripe_publishable_key",
                "value" => "pk_test_51Oskc1HZ9ikP0dBaqshmx8G4zlGTU7j2nInEYYDJ5AVImD0kXgC5e4KuksCFp63Z3af60e0TeCRJTsMSBbpN4RGG00W092r3AKpk_test_51Oskc1HZ9ikP0dBaqshmx8G4zlGTU7j2nInEYYDJ5AVImD0kXgC5e4KuksCFp63Z3af60e0TeCRJTsMSBbpN4RGG00W092r3AK",
                "created_at" => "2024-03-10 13:40:55",
                "updated_at" => "2024-03-10 13:40:55",
            ),
            array(
                "id" => 14,
                "key" => "stripe_secret_key",
                "value" => "sk_test_51Oskc1HZ9ikP0dBap2DVpDlb47WkQBNajLktqyWcpgKJHxakbQWKcwtWOMDlQ8axff3qlu0A1pWDgdFiopwvfdSh00XPsuyxGo",
                "created_at" => "2024-03-10 13:45:06",
                "updated_at" => "2024-03-10 13:45:06",
            ),
            array(
                "id" => 15,
                "key" => "razorpay_status",
                "value" => "active",
                "created_at" => "2024-03-11 04:21:44",
                "updated_at" => "2024-03-11 04:21:44",
            ),
            array(
                "id" => 16,
                "key" => "razorpay_country",
                "value" => "IN",
                "created_at" => "2024-03-11 04:21:44",
                "updated_at" => "2024-03-11 04:21:44",
            ),
            array(
                "id" => 17,
                "key" => "razorpay_currency_name",
                "value" => "IDR",
                "created_at" => "2024-03-11 04:21:44",
                "updated_at" => "2024-03-11 04:21:44",
            ),
            array(
                "id" => 18,
                "key" => "razorpay_currency_rate",
                "value" => "83.19",
                "created_at" => "2024-03-11 04:21:44",
                "updated_at" => "2024-03-11 04:21:44",
            ),
            array(
                "id" => 19,
                "key" => "razorpay_key",
                "value" => "rzp_test_K7CipNQYyyMPiS",
                "created_at" => "2024-03-11 04:21:44",
                "updated_at" => "2024-03-11 05:11:21",
            ),
            array(
                "id" => 20,
                "key" => "razorpay_secret_key",
                "value" => "zSBmNMorJrirOrnDrbOd1ALO",
                "created_at" => "2024-03-11 04:21:44",
                "updated_at" => "2024-03-11 05:11:21",
            ),
        );

        \DB::table('payment_settings')->insert($payment_settings);

    }
}
