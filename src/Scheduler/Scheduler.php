<?php

use Symfony\Component\Scheduler\Attribute\AsSchedule;
use Symfony\Component\Scheduler\RecurringMessage;
use Symfony\Component\Scheduler\ScheduleProviderInterface;
use Symfony\Component\Scheduler\Schedule;

#[AsSchedule(name: 'default')]
class Scheduler implements ScheduleProviderInterface
{
    public function getSchedule(): Schedule
    {
        return (new Schedule())
            ->add(RecurringMessage::every('1 day', new \App\Command\ExtractDataCommand()))
            ->add(RecurringMessage::every('1 day', new \App\Command\TransformDataCommand()))
            ->add(RecurringMessage::every('1 day', new \App\Command\UploadToSftpCommand()));
    }
}
