<?php

namespace App\Listeners;

/**
 * Class ChangeCustomerRoleToEProvider
 * @package App\Listeners
 */
class ChangeCustomerRoleToEProvider
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if ($event->newEProvider->accepted && !$event->oldEProvider->accepted) {
            foreach ($event->newEProvider->users as $user) {
                $user->syncRoles(['provider']);
            }
        }
    }
}
