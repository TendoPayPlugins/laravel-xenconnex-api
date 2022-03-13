<?php

namespace TendoPay\Integration\XenConnex\Api\Customer;

use PHPUnit\Framework\TestCase;
use TendoPay\Integration\XenConnex\Api\ValidationException;

class CustomerTest extends TestCase
{
    private const UUID = 'ef417ee0-a2e8-11ec-b909-0242ac120002';

    /**
     * @dataProvider invalidMobileNumbers
     */
    public function testShouldNotBuildWithInvalidMobileNumber(string $invalidMobileNumber)
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('mobile_number='.$invalidMobileNumber.' is invalid. It should follow /^\+[1-9]\d{1,14}$/ pattern.');
        Customer::builder(CustomerTest::UUID)->withMobileNumber($invalidMobileNumber);
    }

    public function testShouldNotBuildWithInvalidPhoneNumber()
    {
        $phoneNumber51Chars = str_repeat('1234567890', 5).'1';
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('phone_number='.$phoneNumber51Chars.' is invalid. Length should be <= 50 characters.');
        Customer::builder(CustomerTest::UUID)
                ->withEmail('test@test.tt')
                ->withPhoneNumber($phoneNumber51Chars);
    }

    public function testShouldNotBuildWithInvalidDescription()
    {
        $description501Chars = str_repeat('1234567890', 50).'1';
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('description='.$description501Chars.' is invalid. Length should be <= 500 characters.');
        Customer::builder(CustomerTest::UUID)
                ->withEmail('test@test.tt')
                ->withDescription($description501Chars);
    }

    /**
     * @dataProvider validCustomers
     */
    public function testShouldCreateValidCustomers(
        array $expected,
        ?string $referenceId,
        ?string $description,
        ?string $email,
        ?string $mobileNumber,
        ?string $phoneNumber
    ) {
        $builder = Customer::builder($referenceId);
        if (isset($email)) {
            $builder = $builder->withEmail($email);
        }
        if (isset($mobileNumber)) {
            $builder = $builder->withMobileNumber($mobileNumber);
        }
        if (isset($description)) {
            $builder = $builder->withDescription($description);
        }
        if (isset($phoneNumber)) {
            $builder = $builder->withPhoneNumber($phoneNumber);
        }
        self::assertEquals($expected, $builder->toArray());
    }

    public function invalidMobileNumbers(): array
    {
        return [['123123123'], ['asd'], [''], ['+1234567890123456']];
    }


    public function validCustomers(): array
    {
        return [
            [
                [
                    'type'          => 'INDIVIDUAL',
                    'reference_id'  => 'ef417ee0-a2e8-11ec-b909-0242ac120002',
                    'description'   => 'description',
                    'email'         => 'asd@as.as',
                    'mobile_number' => '+48834543335',
                    'phone_number'  => '234355434'
                ], 'ef417ee0-a2e8-11ec-b909-0242ac120002', 'description', 'asd@as.as', '+48834543335', '234355434'
            ],
            [
                [
                    'type'          => 'INDIVIDUAL',
                    'reference_id'  => 'ff417ee0-a2e8-45ec-b959-1242ac154302',
                    'description'   => '',
                    'email'         => 'test@as.as',
                    'mobile_number' => '+5533454333',
                    'phone_number'  => '2355434'
                ], 'ff417ee0-a2e8-45ec-b959-1242ac154302', '', 'test@as.as', '+5533454333', '2355434'
            ],
            [
                [
                    'type'         => 'INDIVIDUAL',
                    'reference_id' => 'ff417ee0-a2e8-45ec-b959-1242ac154302',
                    'email'        => 'test@as.as',
                ], 'ff417ee0-a2e8-45ec-b959-1242ac154302', null, 'test@as.as', null, null
            ]
        ];
    }
}
