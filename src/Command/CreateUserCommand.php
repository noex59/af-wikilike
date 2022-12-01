<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
	name: 'app:create-user',
	description: 'Creates a new user.',
	hidden: false,
)]
class CreateUserCommand extends Command{
	private $em;
	private $passwordHasher;

	public function __construct(EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher)
	{
		$this->em = $em;
		$this->passwordHasher = $passwordHasher;
		parent::__construct();
	}

	protected function configure(): void {
		$this->setHelp('This command allows you to create a user...');
		$this->addArgument('email', InputArgument::REQUIRED, 'User email');
		$this->addArgument('password', InputArgument::REQUIRED, 'User password');
	}

	protected function execute(InputInterface $input, OutputInterface $output) {
		try{
			$user = new User();
			$user->setEmail($input->getArgument('email'));
			$user->setPassword($this->passwordHasher->hashPassword(
				$user,
				$input->getArgument('password'))
			);
			$user->setRoles(["ROLE_ADMIN"]);
			$user->setCreatedAt(new \DateTimeImmutable());

			$this->em->persist($user);
			$this->em->flush();

			return Command::SUCCESS;
		}catch (\Exception $e){
			return Command::FAILURE;
		}
	}
}