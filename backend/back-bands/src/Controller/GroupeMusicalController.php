<?php

namespace App\Controller;

use App\Entity\GroupeMusical;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Psr\Log\LoggerInterface;
use Symfony\Component\Serializer\SerializerInterface;


class GroupeMusicalController extends AbstractController
{
    private ManagerRegistry $doctrine;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;
    private $serializer;

    public function __construct(LoggerInterface $logger, ManagerRegistry $doctrine, SerializerInterface $serializer)
    {
        $this->serializer = $serializer;

        $this->doctrine = $doctrine;

        $this->logger = $logger;
    }

    #Route("/groupes-musicaux", name="liste_groupes_musicaux", methods={"GET"})
    #Cors()
    public function listeGroupesMusicaux(): Response
    {
        $entityManager = $this->doctrine->getManager();

        $this->logger->info(json_encode($entityManager));

        $repository = $entityManager->getRepository(GroupeMusical::class);
        $groupesMusicaux = $repository->findAll();

        $serializer = $this->container->get('serializer');
        $versionJSON = $serializer->serialize($groupesMusicaux, 'json');

        return new Response($versionJSON);
    }

    #Route("/groupes-musicaux/{id}", name="actualizeaza_nume_groupe_musical", methods={"PUT"})
    #Cors()
    public function actualizeazaNumeGroupeMusical(Request $request, $id): Response
    {
        $data = json_decode($request->getContent(), true);

        $entityManager = $this->doctrine->getManager();
        $repository = $entityManager->getRepository(GroupeMusical::class);
        $groupeMusical = $repository->find($id);

        if (!$groupeMusical) {
            throw $this->createNotFoundException("Grupul muzical nu a fost găsit.");
        }

        $groupeMusical->setNomDuGroupe($data['nomDuGroupe']);
        $groupeMusical->setOrigine($data['origine']);
        $groupeMusical->setVille($data['ville']);
        $groupeMusical->setAnneeDebut($data['anneeDebut']);
        $groupeMusical->setAnneeSeparation($data['anneeSeparation']);
        $groupeMusical->setFondateurs($data['fondateurs']);
        $groupeMusical->setMembres($data['membres']);
        $groupeMusical->setCourantMusical($data['courantMusical']);
        $groupeMusical->setPresentation($data['presentation']);

        $entityManager->persist($groupeMusical);
        $entityManager->flush();

        return $this->json($groupeMusical);
    }


    #Route("/groupes-musicaux/{id}", name="supprimer_groupe_musical", methods={"DELETE"}) 
    #Cors()
    public function supprimerGroupeMusical($id): Response
    {
        $entityManager = $this->doctrine->getManager();
        $repository = $entityManager->getRepository(GroupeMusical::class);
        $groupeMusical = $repository->find($id);

        if (!$groupeMusical) {
            throw $this->createNotFoundException("Le groupe musical n'a pas été trouvé.");
        }

        $entityManager->remove($groupeMusical);
        $entityManager->flush();

        return $this->json(['message' => 'Le groupe musical a été supprimé.']);
    }

    #Route("/groupes-musicaux/upload-excel", name="groupe_musical_upload", methods={"POST"})
    #Cors()
    public function uploadExcel(Request $request)
    {
        $file = $request->files->get('file');

        if (!$file || $file->getError() !== UPLOAD_ERR_OK) {
            return new JsonResponse(['error' => 'No valid file uploaded.'], Response::HTTP_BAD_REQUEST);
        }

        $reader = IOFactory::createReaderForFile($file->getPathname());
        $spreadsheet = $reader->load($file->getPathname());
        $worksheet = $spreadsheet->getActiveSheet();
        $excelData = $worksheet->toArray();

        $entityManager = $this->doctrine->getManager();
        if ($this->importExcelData($excelData, $entityManager)) {
            return new JsonResponse(['message' => 'Data imported successfully.'], Response::HTTP_OK);
        } else {
            return new JsonResponse(['error' => 'Failed to import data.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Insert Excel data into the database
     *
     * @param array $excelData
     * @return bool
     */
    private function importExcelData(array $excelData, EntityManagerInterface $entityManager)
    {
        for ($i = 1; $i < count($excelData); $i++) {
            $row = $excelData[$i];

            $musicalGroup = new GroupeMusical();

            $musicalGroup->setNomDuGroupe($row[0]);
            $musicalGroup->setOrigine($row[1]);
            $musicalGroup->setVille($row[2]);
            $musicalGroup->setAnneeDebut($row[3]);
            $musicalGroup->setAnneeSeparation($row[4]);
            $musicalGroup->setFondateurs($row[5]);
            $musicalGroup->setMembres($row[6]);
            $musicalGroup->setCourantMusical($row[7]);
            $musicalGroup->setPresentation($row[8]);

            $entityManager->persist($musicalGroup);
        }

        $entityManager->flush();
    }
}
