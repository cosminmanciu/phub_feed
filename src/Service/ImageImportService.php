<?php

namespace App\Service;


class ImageImportService implements ImageImportServiceInterface
{

    /** @var ActorBuilderInterface */
    private $movieBuilder;

    /**
     * @param ActorBuilderInterface $movieBuilder
     */
    public function __construct(

        ActorBuilderInterface $movieBuilder
    )
    {
        $this->movieBuilder = $movieBuilder;
    }

    /**
     * @param string $source
     * @param int $batch
     * @return void
     */
    public function import(string $source, int $batch = 100): void
    {

        $json = file_get_contents($source);
        $data = json_decode($json, true);

        $data = $data['items'];

        foreach ($data as  $item) {
            $this->movieBuilder->build($item);
        }

    }

}
