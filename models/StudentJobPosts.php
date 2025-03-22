<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student_job_posts".
 *
 * @property int $id
 * @property int|null $posted_by
 * @property string $title
 * @property string $details
 * @property string $location
 * @property string $phone_number
 * @property string $subject
 * @property string|null $level
 * @property string|null $want
 * @property string|null $meeting_option
 * @property string|null $post_code
 * @property int|null $budget
 * @property string|null $gender
 * @property string|null $need_some
 * @property string|null $tutor_from
 * @property string|null $post_status
 * @property int|null $active
 * @property int|null $deleted
 * @property string $created_at
 * @property string $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class StudentJobPosts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student_job_posts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['posted_by', 'budget', 'active', 'deleted', 'created_by', 'updated_by'], 'integer'],
            [['title', 'details', 'location', 'phone_number', 'subject'], 'required'],
            [['details', 'want', 'gender', 'need_some', 'post_status'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'location'], 'string', 'max' => 255],
            [['phone_number', 'post_code'], 'string', 'max' => 20],
            [['subject', 'level', 'tutor_from'], 'string', 'max' => 100],
            [['meeting_option'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'posted_by' => 'Posted By',
            'title' => 'Title',
            'details' => 'Details',
            'location' => 'Location',
            'phone_number' => 'Phone Number',
            'subject' => 'Subject',
            'level' => 'Level',
            'want' => 'Want',
            'meeting_option' => 'Meeting Option',
            'post_code' => 'Post Code',
            'budget' => 'Budget',
            'gender' => 'Gender',
            'need_some' => 'Need Some',
            'tutor_from' => 'Tutor From',
            'post_status' => 'Post Status',
            'active' => 'Active',
            'deleted' => 'Deleted',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return StudentJobPostsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StudentJobPostsQuery(get_called_class());
    }

    public function getPostedBy()
    {
        return $this->hasOne(User::class, ['id' => 'posted_by']);
    }
    public function getMessages()
    {
        return $this->hasMany(ChatMessages::class, ['job_post_id' => 'id']);
    }
    public function getApplies()
    {
        return $this->hasMany(JobApplications::class, ['job_id' => 'id']);
    }
}
