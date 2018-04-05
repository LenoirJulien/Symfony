<?php

namespace App\Repository;

use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Entity\Tag;

class TagRepository extends MainRepository{
    public function __construct(RegistryInterface $registry){
        parent::__construct($registry, Tag::class);
    }
}
