<?php

use Illuminate\Database\Seeder;

class RemoveJobOpeningNotePermissionSeeder extends Seeder
{
    use PermissionsUtility;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->removePermission('notes.job-opening');
    }
}
