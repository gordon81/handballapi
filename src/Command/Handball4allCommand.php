<?php

namespace App\Command;

use App\Entity\Club;
use App\Entity\League;
use App\Repository\ClubRepository;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:handball4all',
    description: 'Add a short description for your command',
)]
class Handball4allCommand extends Command
{

    private $club = 2589;
    private \GuzzleHttp\Client $client;


    public function __construct(
        private ClubRepository $clubRepository,
        private EntityManagerInterface $entityManager,
    ){
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument('clubId', InputArgument::OPTIONAL, 'Id of the Club',2589);
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        try {
            $this->getClient();
        } catch (\Exception $e) {
            $io->error($e->getMessage());
            return Command::FAILURE;
        }
        $clubId = $input->getArgument('clubId');
        $club = $this->clubRepository->findByH4aId($clubId);
        $clubLiga = $this->getClubDataList($clubId);

        if ($club instanceof Club){

        }else{

            $club = Club::do($clubLiga[0]);
            $this->entityManager->persist($club);
            $this->entityManager->flush();
            $ligas = [];
            foreach($clubLiga[0]->dataList as $ligaData){
                $league = League::do($ligaData);
                $this->entityManager->persist($league);
                $ligas[]= $league;
            }

            $this->entityManager->flush();

        }




        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;



        //  GET BASE URL https://api.handball4all.de/url/spo_vereine-01.php

        // GET  https://spo.handball4all.de/service/if_g_json.php?c=2589&cmd=pcu&og=3&p=111

        //    https://spo.handball4all.de/service/if_g_json.php?c=2589&og=81&p=111

//https://api.h4a.mobi/spo/spo-proxy_public.php?cmd=data&lvTypeNext=team&lvIDNext=xxxxxx


    }

    private function getClient()
    {
        $client = new \GuzzleHttp\Client();
        $result = $client->get('https://api.handball4all.de/url/spo_vereine-01.php');
        if ($result->getStatusCode() !== 200) {
            throw new \Exception('get Base Url failed');
        }
        $baseUrl = trim($result->getBody()->getContents());
        $this->client = new \GuzzleHttp\Client(['base_uri' => $baseUrl]);
    }


    public function getClubDataList($club = 0) : array
    {
        $respose = $this->client->request('GET', '',['query' =>[
            'cmd'=>'data',
            'lvTypeNext'=>'club',
            'lvIDNext'=> $club
        ]]);
        if ($respose->getStatusCode() !== 200) {
            throw new \Exception('get Url failed');
        }
        $content = $respose->getBody()->getContents();

       if($content )  {
           return json_decode($content);
       }
       return [];
    }



}