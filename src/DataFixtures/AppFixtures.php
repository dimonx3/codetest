<?php

namespace App\DataFixtures;

use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private const PRODUCTS_COUNT = 100;
    private const ORDERS_COUNT = 100;

    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create();

        // Create Products
        $products = [];
        for ($i = 1; $i <= self::PRODUCTS_COUNT; ++$i) {
            $product = (new Product())
                ->setName($faker->word)
                ->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-1 years', 'now')))
                ->setUpdatedAt(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-1 years', 'now')))
                ->setCount($faker->numberBetween(0, 30))
                ->setPrice($faker->numberBetween(0, 1000))
            ;

            $products[] = $product;
            $manager->persist($product);
        }

        // Create Orders
        for ($i = 1; $i <= self::ORDERS_COUNT; ++$i) {
            $order = (new Order())
                ->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-1 month', 'now')))
            ;
            $manager->persist($order);

            foreach ($faker->randomElements($products, $faker->numberBetween(1, 10)) as $product) {
                $orderItem = (new OrderItem)
                    ->setOrder($order)
                    ->setProduct($product)
                    ->setCount($faker->numberBetween(1, 5))
                ;
                $manager->persist($orderItem);
            }

        }

        $manager->flush();
    }
}
