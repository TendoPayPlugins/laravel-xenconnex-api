<?php

namespace TendoPay\Integration\XenConnex;

use Orchestra\Testbench\TestCase;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use TendoPay\Integration\XenConnex\Api\Customers\BusinessDetail;
use TendoPay\Integration\XenConnex\Api\Customers\Constants\BusinessType;
use TendoPay\Integration\XenConnex\Api\Customers\Constants\Gender;
use TendoPay\Integration\XenConnex\Api\Customers\Customer;
use TendoPay\Integration\XenConnex\Api\Customers\IndividualDetail;
use TendoPay\Integration\XenConnex\Api\Exceptions\ApiEndpointErrorException;
use TendoPay\Integration\XenConnex\Api\Exceptions\ValidationException;

class CustomerServiceTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [XenConnexServiceProvider::class];
    }

    /**
     * @throws Api\Exceptions\ApiEndpointErrorException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ValidationException
     */
    public function testShouldCreateCustomerWithEmail()
    {
        /**
         * @var $service CustomersService
         */
        $service     = $this->app->get(CustomersService::class);
        $referenceId = uniqid();
        $result      = $service->create(
            Customer::builder($referenceId)
                    ->withEmail('asd@as.aa')
                    ->withIndividualDetail(IndividualDetail::builder('mygivennames')
                                                           ->withGender(Gender::MALE))
                    ->withMetadata(['meta' => 'data'])
        );

        self::assertEquals($referenceId, $result->reference_id);
        self::assertEquals('asd@as.aa', $result->email);
        self::assertEquals('mygivennames', $result->individual_detail->given_names);
        self::assertEquals('data', $result->metadata->meta);
    }

    /**
     * @throws Api\Exceptions\ApiEndpointErrorException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ValidationException
     */
    public function testShouldCreateCustomerWithMobileNumber()
    {
        /**
         * @var $service CustomersService
         */
        $service     = $this->app->get(CustomersService::class);
        $referenceId = uniqid();
        $result      = $service->create(
            Customer::builder($referenceId)
                    ->withMobileNumber('+48559844457')
                    ->withIndividualDetail(IndividualDetail::builder('mygivennames'))
                    ->withBusinessDetail(BusinessDetail::builder('mybuiseness', BusinessType::CORPORATION))
                    ->withMetadata(['meta' => 'data'])
        );

        self::assertEquals($referenceId, $result->reference_id);
        self::assertEquals('+48559844457', $result->mobile_number);
        self::assertEquals('mygivennames', $result->individual_detail->given_names);
        self::assertEquals('data', $result->metadata->meta);
    }

    /**
     * @throws Api\Exceptions\ApiEndpointErrorException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ValidationException
     */
    public function testShouldNotCreateCustomerWithoutGivenNames()
    {
        $this->expectException(ApiEndpointErrorException::class);
        $this->expectExceptionMessage("There was an error with the format submitted to the server.");
        /**
         * @var $service CustomersService
         */
        $service     = $this->app->get(CustomersService::class);
        $referenceId = uniqid();
        $service->create(
            Customer::builder($referenceId)
                    ->withEmail('test@as.px')
        );
    }
}
