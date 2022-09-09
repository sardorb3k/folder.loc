<?php
namespace App\Interfaces;

use App\Http\Requests\UpdateGroupsRequest;
use App\Http\Requests\StoreGroupsRequest;
use App\Models\Groups;
use Illuminate\Http\Request;

interface GroupsServiceInterface
{
    public function getAllGroups();
    public function getCountGroups();
    public function getGroupById(int $id);
    public function getGroupInfoById(int $id): Array;
    public function getCountGroupStudents(int $id): int;
    public function getGroupStudents(int $id);
    public function groupSubscriptionStudents(Request $request): void;
    public function groupUnsubscriptionStudents(Request $request): void;
    public function getUnsubscribeList(int $id): array;
    public function deleteGroup(int $id): void;
    public function updateGroup(Request $request, int $id): void;


}