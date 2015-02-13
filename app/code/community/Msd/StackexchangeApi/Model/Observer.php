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

    /*
     * Update global site statistics via cronjob
     */

    public function updateSiteStats() {
        $helper = Mage::helper('msd_stackexchangeapi');
        $seClient = Mage::getModel('msd_stackexchangeapi/api');
        $seInfo = Zend_Json::decode($seClient->getDataFromUrl($helper->getAreaUrl()));
        $data = $seInfo['items'][0];
        $model = Mage::getModel('msd_stackexchangeapi/statistics');
        $date = Mage::getModel('core/date')->date('Y-m-d H:i:s');

        try {
            $model->setDate($date);
            $model->setNewActiveUsers($data['new_active_users']);
            $model->setTotalUsers($data['total_users']);
            $model->setBadgesPerMinute($data['badges_per_minute']);
            $model->setTotalBadges($data['total_badges']);
            $model->setTotalVotes($data['total_votes']);
            $model->setTotalComments($data['total_comments']);
            $model->setAnswersPerMinute($data['answers_per_minute']);
            $model->setQuestionsPerMinute($data['questions_per_minute']);
            $model->setTotalAnswers($data['total_answers']);
            $model->setTotalAccepted($data['total_accepted']);
            $model->setTotalUnanswered($data['total_unanswered']);
            $model->setTotalQuestions($data['total_questions']);
            $model->setActive(1);
            $model->save();
        }
        catch(Exception $e) {
            Mage::log("Exception during cronjob: ".$e->getMessage());
        }
    }
}