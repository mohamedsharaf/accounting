<?php

namespace App\Helpers;
use App\Account;

class AccountHelper {

    ///getChildrenOfParents
    ///pass all account to get nested children
    static public function getChildrenOfParents($accounts)
    {
        foreach ($accounts as  $account) {
            if ($account != null) {
                $children = Account::where('parent_id', $account->id)->get();
                $account['children'] = $children;
                self::getChildrenOfParents($account['children']);
            }
        }
        return $accounts;
    }

    //getAccountLevel
    //pass parent id of any account to get its current level
    static public function getAccountLevel($parent_id, $level = 1)
    {
        //if null meant it's parent return default level that 0
        if ($parent_id == null) return $level;
        //get parent of this account
        $parent = Account::find($parent_id);
        //if parent not exist return default also level that 0
        if ($parent == null) return $level;
        //increment level by one level
        $level++;
        //then if parent doesn't have parent return incremented level
        if ($parent->parent_id == null) return $level;
        //else re call this function with new level
        return self::getAccountLevel($parent->parent_id, $level);
    }
}