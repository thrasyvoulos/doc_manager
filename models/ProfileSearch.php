<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Profile;

/**
 * ProfileSearch represents the model behind the search form about `app\models\Profile`.
 */
class ProfileSearch extends Profile
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profileid', 'accountid', 'specialtiesid', 'cityid', 'sex'], 'integer'],
            [['firstname', 'lastname', 'address', 'zipcode', 'birthdate', 'birthplace', 'mobilephone', 'telephone', 'email', 'gps', 'createddate'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {   
        if(Yii::$app->user->isGuest){
            $query = Profile::find();
        }
        else if(Yii::$app->user->identity->roleid==Role::ROLE_USER){
            $query = Profile::find()->where(['accountid' => Yii::$app->user->identity->accountid]);
        }else {
            $query = Profile::find();
        }
        //$query = Profile::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'profileid' => $this->profileid,
            'accountid' => $this->accountid,
            'specialtiesid' => $this->specialtiesid,
            'cityid' => $this->cityid,
            'birthdate' => $this->birthdate,
            'sex' => $this->sex,
            'createddate' => $this->createddate,
        ]);

        $query->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'fathersname', $this->fathersname])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'zipcode', $this->zipcode])
            ->andFilterWhere(['like', 'birthplace', $this->birthplace])
            ->andFilterWhere(['like', 'mobilephone', $this->mobilephone])
            ->andFilterWhere(['like', 'telephone', $this->telephone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'gps', $this->gps]);

        return $dataProvider;
    }
}
