<?php

# 1. NULLSafe Operator
class User {
    public function getProfile() {
        //return null;
        return new Profile;
    }
}

class Profile{
    public function getTitle() {
        //return null;
        return "Software Engineer";
    }
}

$user = new User;
$profile = $user->getProfile();

echo $user->getProfile()?->getTitle() ?? 'Not provided';

# 2. Constructor Property Promotion
class Signup {
    public function __construct(protected UserInfo $user, protected PlanInfo $plan) {
    }
}

class UserInfo {
    public function __construct(protected string $username) {
    }
}

class PlanInfo {
    public function __construct(protected string $name = 'yearly') {
    }
}

$userInfo = new UserInfo('Test Account');
$planInfo = new PlanInfo('monthly');

$signup = new Signup($userInfo, $planInfo);

echo '<pre>';
print_r($signup);
echo '</pre>';

$planInfo = new PlanInfo();

$signup = new Signup($userInfo, $planInfo);

echo '<pre>';
print_r($signup);
echo '</pre>';
echo '<br>';

# 3. Match Expressions
class Send{}
$message = new Send();

$test = 'Send';

$type = match (get_class($message)) {
    'Send'=>'send_message',
    'Remove'=>'remove_message'
};

echo $type;
echo '<br>';

# 4. $object::class
$message = new Send();

$test = 'Send';

$type = match ($message::class) {
    'Send'=>'send_message',
    'Remove'=>'remove_message'
};

echo $type;
echo '<br>';

# 5. Named Parameters
class Invoice {
    public function __construct(private string $customer, private int $amount, private dateTime $date) {}
}

$invoice = new Invoice(
    customer: 'Test Account', 
    amount: 100, 
    date: new DateTime
);

echo '<pre>';
print_r($invoice);
echo '</pre>';
echo '<br>';

# 6. String Helpers
$string = 'inv_1234_mid_67890_rec';
echo 'Starts with inv_: '.(str_starts_with($string, 'inv_') ? "Yes" : "No");
echo '<br>';
echo 'Ends with _rec: '.(str_ends_with($string, '_rec') ? "Yes" : "No");
echo '<br>';
echo 'Contains _mid_: '.(str_contains($string, '_mid_') ? "Yes" : "No");
echo '<br>';
# 7. Union and Pseudo Types
class Foo {

    public function bar(Foo|string|null $foo) {
        echo 'Complete';
    }
}

$one = new Foo;
$two = new Foo;

$two->bar($one);
echo '<br>';
$two->bar(null);
echo '<br>';
$two->bar('Test');