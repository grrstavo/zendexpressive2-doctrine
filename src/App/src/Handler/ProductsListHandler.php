<?php

namespace App\Handler;

use App\Entity\Product;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class ProductsListHandler implements RequestHandlerInterface
{
    private $template;
    private $entityManager;

    public function __construct(TemplateRendererInterface $template, EntityManager $entityManager)
    {
        $this->template = $template;
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $product = new Product();

        $repository = $this->entityManager->getRepository(Product::class);
        $products = $repository->findAll();

        return new HtmlResponse($this->template->render('app::products/list', ['products' => $products]));
    }
}
