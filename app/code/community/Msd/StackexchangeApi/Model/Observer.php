<?php
/**
 * @category    Msd_StackexchangeApi
 * @package     Model
 * @author      Anna Völkl / @rescueAnn
 */
class Msd_StackexchangeApi_Model_Observer {

    /*
     * Update user statistics via cronjob
     */
    public function updateStats() {
        Mage::log("updateStats");
        $seClient = Mage::getModel('msd_stackexchangeapi/api');
        $collection = Mage::getModel('msd_stackexchangeapi/user')->getCollection();

        foreach($collection as $user) {
            $accesstoken = $user->getAccessToken();

            $data = $seClient->getUserInfo($accesstoken);

            $seUserHistory = Mage::getModel('msd_stackexchangeapi/user_history');
            $seUserHistory->setSeId($user->getId());
            $seUserHistory->setReputation($data["reputation"]);
            $seUserHistory->setUserId($data["user_id"]);
            $seUserHistory->setInsertDate(Mage::getModel('core/date')->date('Y-m-d H:i:s'));
            $seUserHistory->setReputationChangeDay($data["reputation_change_day"]);
            $seUserHistory->setReputationChangeWeek($data["reputation_change_week"]);
            $seUserHistory->setReputationChangeMonth($data["reputation_change_month"]);
            $seUserHistory->setReputationChangeYear($data["reputation_change_year"]);
            $seUserHistory->setUpVoteCount($data["up_vote_count"]);
            $seUserHistory->setDownVoteCount($data["down_vote_count"]);
            $seUserHistory->setAnswerCount($data["answer_count"]);
            $seUserHistory->setViewCount($data["view_count"]);
            $seUserHistory->setQuestionCount($data["question_count"]);
            $seUserHistory->setBadgeCounts(serialize($data["badge_counts"]));
            $seUserHistory->save();

        }
    }
}