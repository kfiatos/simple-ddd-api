<?php

namespace App\Products\Infastructure\Http;

use App\Products\Application\Create\ProductCreateCommand;
use App\Products\Application\Find\ProductFinder;
use App\Products\Domain\Dto\NewProductDto;
use App\Products\Domain\ValueObject\Name;
use League\Tactician\CommandBus;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints;

class ProductController extends AbstractController
{
    protected ValidatorInterface $validator;

    protected LoggerInterface $logger;

    /**
     * ProductController constructor.
     *
     * @param ValidatorInterface $validator
     * @param LoggerInterface $logger
     */
    public function __construct(ValidatorInterface $validator, LoggerInterface $logger)
    {
        $this->validator = $validator;
        $this->logger = $logger;
    }

    /**
     * @Route("/product/", name="create_product", methods={"PUT"})
     *
     */
    public function create(Request $request, ProductFinder $productFinder, CommandBus $commandBus)
    {
        try {
            $dto = NewProductDto::createFromCreateProductRequest($request);

            $validationErrors = $this->validateCreateProductRequest($dto);

            if (count($validationErrors) > 0) {
                return new Response(json_encode($validationErrors), Response::HTTP_BAD_REQUEST);
            }

            $productCreateCommand = new ProductCreateCommand(
                $dto->getName(),
                $dto->getPrice(),
                $dto->getPriceCurrency()
            );

            $commandBus->handle($productCreateCommand);

            $product = $productFinder->findLastCreated();

            return new Response(json_encode($product), Response::HTTP_CREATED);
        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage());

            return new Response($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }

    }

    /**
     * @param array $inputValues
     * @param ValidatorInterface $validator
     *
     * @return array
     */
    private function validateCreateProductRequest(NewProductDto $apiRequestDTO): array
    {
        $constraints = new Constraints\Collection([
            'name' => [new Constraints\Type('string'), new Constraints\NotBlank(), new Constraints\Length(['min' => Name::MIN_NAME_LENGTH])],
            'price' => [new Constraints\Type('float'), new Constraints\NotBlank(), new Constraints\GreaterThan(0)],
            'currency' => [new Constraints\Type('string')],
        ]);

        $validationResult = $this->validator->validate($apiRequestDTO->toArray(), $constraints);

        $errors = [];
        if ($validationResult->count() > 0) {
            foreach ($validationResult as $error) {
                $errors[] = $error->getMessage();
            }

            return $errors;
        }

        return [];
    }
}


