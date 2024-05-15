<?php

namespace App\Http\Controllers\Dashboard;
use App\DataTables\InvitationsDataTable;
use App\Models\Invitation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class InvitationsController extends Controller
{
    public function __invoke(InvitationsDataTable $dataTable)
    {
        return $dataTable->render('dashboard.invitations.index');
    }

    }
