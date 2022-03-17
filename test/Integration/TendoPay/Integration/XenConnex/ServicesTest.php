<?php

namespace TendoPay\Integration\XenConnex;

use Orchestra\Testbench\TestCase;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use TendoPay\Integration\XenConnex\Api\Customers\Constants\Gender;
use TendoPay\Integration\XenConnex\Api\Customers\Customer;
use TendoPay\Integration\XenConnex\Api\Customers\IndividualDetail;
use TendoPay\Integration\XenConnex\Api\Exceptions\ApiEndpointErrorException;
use TendoPay\Integration\XenConnex\Api\Exceptions\ValidationException;
use TendoPay\Integration\XenConnex\Api\Tokens\LinkProperties;
use TendoPay\Integration\XenConnex\Api\Tokens\Token;
use TendoPay\Integration\XenConnex\Api\Transactions\GetTransactionsParams;

class ServicesTest extends TestCase
{
    //'cust-e1634e54-f7f6-4361-ab01-e3c354dd61fe'
    private static string $customerId;
    //'lt-96530a62-e918-44ba-aa47-722fd2d4b828'
    private static string $tokenId;

    protected function getPackageProviders($app): array
    {
        return [XenConnexServiceProvider::class];
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

    /**
     * @throws Api\Exceptions\ApiEndpointErrorException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ValidationException
     */
    public function testShouldCreateCustomer()
    {
        if (isset(self::$customerId)) {
            //test omitted
            self::assertTrue(true);

            return;
        }
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

        self::$customerId = $result->id;
    }

    /**
     * @depends testShouldCreateCustomer
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     * @throws Api\Exceptions\ApiEndpointErrorException
     * @throws ValidationException
     */
    public function testShouldCreateToken()
    {
        if (isset(self::$tokenId)) {
            //test omitted
            self::assertTrue(true);

            return;
        }
        /**
         * @var $service LinkTokensService
         */
        $service    = $this->app->get(LinkTokensService::class);
        $properties = LinkProperties::builder('https://success.full', 'https://success.full',
            'https://success.full');

        $result = $service->create(Token::builder(self::$customerId, ['TRANSACTION'],
            $properties)->withInstitutionCodes(['ID_BCA']));
        self::assertEquals(self::$customerId, $result->customer_id);

        self::$tokenId = $result->id;
    }

    /**
     * @depends testShouldCreateToken
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     * @throws Api\Exceptions\ApiEndpointErrorException
     */
    public function testShouldGetTokenDetails()
    {
        /**
         * @var $service LinkTokensService
         */
        $service = $this->app->get(LinkTokensService::class);

        $detailsResult = $service->getDetails('lt-65604978-b060-488d-861c-45464d70c3fc', '');
        self::assertEquals('LINK_CREATED', $detailsResult->status);

    }

    /**
     * @depends testShouldCreateToken
     * @throws Api\Exceptions\ApiEndpointErrorException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function testShouldGetIdentity()
    {
        /**
         * @var $service IdentityService
         */
        $service = $this->app->get(IdentityService::class);
        //TODO: path":"/v1/identity not found
        $this->expectException(ApiEndpointErrorException::class);
        $service->get(self::$tokenId);
    }

    /**
     * @depends testShouldCreateToken
     * @throws Api\Exceptions\ApiEndpointErrorException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function testShouldGetTransactions()
    {
        /**
         * @var $service TransactionsService
         */
        $service           = $this->app->get(TransactionsService::class);
        $transactionParams = new GetTransactionsParams();
        $transactionParams->setCount(10);

        //Link token is not linked
        $this->expectException(ApiEndpointErrorException::class);
        $service->get(self::$tokenId, $transactionParams);
    }

    /**
     * @depends testShouldCreateToken
     * @throws Api\Exceptions\ApiEndpointErrorException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function testShouldRefreshTransactions()
    {
        /**
         * @var $service TransactionsService
         */
        $service = $this->app->get(TransactionsService::class);

        //Link token is not linked
        $this->expectException(ApiEndpointErrorException::class);
        $service->refresh(self::$tokenId);
    }

    /**
     * @depends testShouldRefreshTransactions
     * @depends testShouldGetTransactions
     * @depends testShouldGetTokenDetails
     * @depends testShouldGetIdentity
     * @depends testShouldCreateToken
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     * @throws Api\Exceptions\ApiEndpointErrorException
     */
    public function testShouldInvalidateToken()
    {
        /**
         * @var $service LinkTokensService
         */
        $service = $this->app->get(LinkTokensService::class);

        $result = $service->invalidate(self::$tokenId);
        self::assertEquals('INVALIDATED', $result->status);
    }
}
