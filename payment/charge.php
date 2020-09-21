<?php
  require_once('vendor/autoload.php');

  require_once __DIR__ . '/../../pomocServicesAPI/service/InterventionManage.php';
  require_once __DIR__ . '/../../pomocServicesAPI/DataBaseManager.php';

  require_once __DIR__ . '/../../pomocServicesAPI/models/CustomerPay.php';
  require_once __DIR__ . '/../../pomocServicesAPI/models/Transaction.php';


  \Stripe\Stripe::setApiKey('sk_test_43SYZInY9tX2lsg26AKzN2Lf00XPo3OYfF');

 // Sanitize POST Array
 $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

 $first_name = $POST['first_name'];
 $last_name = $POST['last_name'];
 $email = $POST['email'];
 $token = $POST['stripeToken'];

// Create Customer In Stripe
$customer = \Stripe\Customer::create(array(
  "email" => $email,
  "source" => $token
));

$manager = new DatabaseManager();
$interventionManage = new InterventionManage($manager);
$intervention = $interventionManage->getInterventionPay();


$amount = $intervention['duration'] * $intervention['price']*100;

// Charge Customer
$charge = \Stripe\Charge::create(array(
  "amount" => $amount,
  "currency" => "eur",
  "description" => $intervention['title'],
  "customer" => $customer->id
));

// Customer Data
$customerData = [
  'id' => $charge->customer,
  'first_name' => $first_name,
  'last_name' => $last_name,
  'email' => $email
];

// Instantiate Customer
$customerPay = new CustomerPay();

// Add Customer To DB
$customerPay->addCustomerPay($customerData);


// Transaction Data
$transactionData = [
  'id' => $charge->id,
  'customer_id' => $charge->customer,
  'product' => $charge->description,
  'amount' => $charge->amount,
  'currency' => $charge->currency,
  'status' => $charge->status,
];

// Instantiate Transaction
$transaction = new Transaction();

// Add Transaction To DB
$transaction->addTransaction($transactionData);

// Redirect to success
header('Location: success.php?tid='.$charge->id.'&product='.$charge->description.'&first_name='.$first_name);
