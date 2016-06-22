<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Rvperson;

/**
 * RvpersonSearch represents the model behind the search form about `app\models\Rvperson`.
 */
class RvpersonSearch extends Rvperson
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rvpersonid', 'cityid', 'sex'], 'integer'],
            [['firstname', 'lastname', 'fathername', 'address', 'zipcode', 'birthdate', 'birthplace', 'mobilephone', 'telephone', 'email', 'gps', 'createddate'], 'safe'],
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
       // $query = Rvperson::find();
        if(Yii::$app->user->identity->roleid==Role::ROLE_USER){
                $query = Rvperson::find()
                ->joinWith(['accountrvpersons'])
                ->where(['accountrvperson.accountid' => Yii::$app->user->identity->accountid]);
        }else {
            $query = Rvperson::find();
        }
       
                
        //$query->compare('accountrvpersons.acoountid',Yii::$app->user->identity->accountid);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        //var_dump($dataProvider);exit;
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'rvpersonid' => $this->rvpersonid,
            'cityid' => $this->cityid,
            'birthdate' => $this->birthdate,
            'sex' => $this->sex,
            'createddate' => $this->createddate,
        ]);

        $query->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'fathername', $this->fathername])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'zipcode', $this->zipcode])
            ->andFilterWhere(['like', 'birthplace', $this->birthplace])
            ->andFilterWhere(['like', 'mobilephone', $this->mobilephone])
            ->andFilterWhere(['like', 'telephone', $this->telephone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'gps', $this->gps]);

        return $dataProvider;
    }
}
