<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Crmlog;

/**
 * CrmlogSearch represents the model behind the search form about `app\models\Crmlog`.
 */
class CrmlogSearch extends Crmlog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['crmlogid', 'crmtypeid', 'accountid', 'rvpersonid', 'status'], 'integer'],
            [['description', 'createddate', 'fromdate','todate'], 'safe'],
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
        if(Yii::$app->user->identity->roleid==Role::ROLE_USER){
           $query = Crmlog::find()->where(['accountid' => Yii::$app->user->identity->accountid])
               ->orderBy(['createddate' => SORT_DESC]);
        } else {

           $query = Crmlog::find();
        }
      

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
            'crmlogid' => $this->crmlogid,
            'crmtypeid' => $this->crmtypeid,
            'accountid' => $this->accountid,
            'rvpersonid' => $this->rvpersonid,
            'DATE(createddate)' => $this->createddate,
            'DATE(fromdate)' => $this->fromdate,
            'DATE(todate)' => $this->todate,
            'status' => $this->status,

        ]);

        $query->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
