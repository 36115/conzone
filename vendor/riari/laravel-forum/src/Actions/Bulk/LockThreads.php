<?php

namespace TeamTeaTime\Forum\Actions\Bulk;

use Illuminate\Support\Facades\DB;
use TeamTeaTime\Forum\Actions\BaseAction;
use TeamTeaTime\Forum\Models\BaseModel;
use TeamTeaTime\Forum\Models\Thread;

class LockThreads extends BaseAction
{
    private array $threadIds;
    private bool $includeTrashed;

    public function __construct(array $threadIds, bool $includeTrashed)
    {
        $this->threadIds = $threadIds;
        $this->includeTrashed = $includeTrashed;
    }

    protected function transact()
    {
        $query = DB::table(Thread::getTableName())
            ->whereIn('id', $this->threadIds)
            ->where(['locked' => false]);

        if (!$this->includeTrashed) {
            $query = $query->whereNull(BaseModel::DELETED_AT);
        }

        $threads = $query->get();

        // Return early if there are no eligible threads in the selection
        if ($threads->count() == 0) {
            return null;
        }

        $query->update(['locked' => true]);

        return $threads;
    }
}
