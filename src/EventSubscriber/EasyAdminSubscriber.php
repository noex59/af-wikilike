<?php

namespace App\EventSubscriber;

use App\Entity\User;
use App\Entity\Exemple;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{
	private $passwordEncoder;

	public function __construct(UserPasswordHasherInterface $passwordEncoder)
	{
		$this->passwordEncoder = $passwordEncoder;
	}

	public static function getSubscribedEvents()
	{
		return [
			BeforeEntityPersistedEvent::class => ['setUserCreatedAtAndPassword'],
			BeforeEntityUpdatedEvent::class => ['setUserPassword'],
		];
	}

	public function setUserCreatedAtAndPassword(BeforeEntityPersistedEvent $event)
	{
		$entity = $event->getEntityInstance();

		if ($entity instanceof User) {
			$password = $this->passwordEncoder->hashPassword(
				$entity,
				$entity->getPassword()
			);

			$entity->setPassword($password);
			$entity->setCreatedAt(new \DateTimeImmutable());
		}

		if ($entity instanceof Exemple) {
			$entity->setCreatedAt(new \DateTimeImmutable());
		}
	}

	public function setUserPassword(BeforeEntityUpdatedEvent $event)
	{
		$entity = $event->getEntityInstance();

		if ($entity instanceof User) {
			$password = $this->passwordEncoder->hashPassword(
				$entity,
				$entity->getPassword()
			);

			$entity->setPassword($password);
		}
	}
}