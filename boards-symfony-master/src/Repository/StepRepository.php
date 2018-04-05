<?php

namespace App\Repository;

use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Entity\Step;

class StepRepository extends MainRepository{
    public function __construct(RegistryInterface $registry){
        parent::__construct($registry, Step::class);
    }
}
