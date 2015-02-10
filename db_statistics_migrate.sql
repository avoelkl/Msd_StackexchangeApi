INSERT INTO stackexchange_statistics (date, new_active_users, total_users, badges_per_minute, total_badges, total_votes, total_comments,
answers_per_minute, questions_per_minute, total_answers, total_accepted, total_unanswered, total_questions, active)
SELECT date, new_active_users, total_users, badges_per_minute, total_badges, total_votes, total_comments, answers_per_minute, questions_per_minute, total_answers, total_accepted, total_unanswered, total_questions, active
FROM magestack_statistics