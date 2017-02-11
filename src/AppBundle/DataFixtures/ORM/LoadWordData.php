<?php

namespace AppBundle\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Word;

class LoadWordData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for($i=0; $i<1000; $i++){
            $word = new Word();
            $words_array[] = $word;
        }

        if ($file = fopen(__DIR__ . "/Words/english.txt", "r")) {
            $txt_file = file_get_contents(__DIR__ . "/Words/english.txt", "r");
            $rows  = explode("\n", $txt_file);
            for($i=0; $i<1000; $i++){
                $words_array[$i]->translate('en')->setName($rows[$i]);
            }
            fclose($file);
        }

        if ($file = fopen(__DIR__ . "/Words/french.txt", "r")) {
            $txt_file = file_get_contents(__DIR__ . "/Words/french.txt", "r");
            $rows  = explode("\n", $txt_file);
            for($i=0; $i<1000; $i++){
                $words_array[$i]->translate('fr')->setName($rows[$i]);
            }
            fclose($file);
        }

        if ($file = fopen(__DIR__ . "/Words/russian.txt", "r")) {
            $txt_file = file_get_contents(__DIR__ . "/Words/russian.txt", "r");
            $rows  = explode("\n", $txt_file);
            for($i=0; $i<1000; $i++){
                $words_array[$i]->translate('ru')->setName($rows[$i]);
            }
            fclose($file);
        }

        if ($file = fopen(__DIR__ . "/Words/german.txt", "r")) {
            $txt_file = file_get_contents(__DIR__ . "/Words/german.txt", "r");
            $rows  = explode("\n", $txt_file);
            for($i=0; $i<1000; $i++){
                $words_array[$i]->translate('de')->setName($rows[$i]);
            }
            fclose($file);
        }

        if ($file = fopen(__DIR__ . "/Words/ukrainian.txt", "r")) {
            $txt_file = file_get_contents(__DIR__ . "/Words/ukrainian.txt", "r");
            $rows  = explode("\n", $txt_file);
            for($i=0; $i<1000; $i++){
                $words_array[$i]->translate('uk')->setName($rows[$i]);
            }
            fclose($file);
        }


        foreach($words_array as &$word){
            $manager->persist($word);
            $word->mergeNewTranslations();
        }

        $manager->flush();

    }

    public function getOrder()
    {
        return 1;
    }
}
