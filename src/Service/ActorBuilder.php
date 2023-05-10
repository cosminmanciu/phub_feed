<?php

namespace App\Service;

use App\Entity\Actor;
use App\Entity\Image;
use Doctrine\ORM\EntityManagerInterface;

class ActorBuilder implements ActorBuilderInterface
{
    /** @var EntityManagerInterface */
    private $em;

    /** @var Actor */
    private $actor;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;

    }

    /**
     * @param array $data
     * @return void
     */
    public function build(array $data): void
    {
        $actor = $this->actor = new Actor();

        $actor->setAttributes(json_encode($data['attributes']))
                    ->setActorId($data['id'] ?? '')
                    ->setName($data['name'] ?? '')
                    ->setLicense($data['license'] ?? '' )
                    ->setWlStatus($data['wlStatus'] ?? '')
                    ->setAliases(json_encode($data['aliases']))
                    ->setLink($data['link'] ?? '');
        foreach ($data['thumbnails'] as $thumbnail) {
            $image = new Image();
            $image->setImageUrls(json_encode($thumbnail['urls']))
                ->setWidth($thumbnail['width'] ?? '')
                ->setHeight($thumbnail['height'] ?? '')
                ->setType($thumbnail['type'] ?? '');

            $this->actor->addImage($image);
            $this->em->persist($image);

        }
        echo ('Imported actor : ' .$actor->getActorId());
        $this->em->persist($actor);
        $this->em->flush();
        $this->em->clear();

    }
}
