<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Orders;

/**
 * OrdersSearch represents the model behind the search form about `app\models\Orders`.
 */
class OrdersSearch extends Orders
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'dost', 'oplata', 'textcomment', 'iduser', 'totprice', 'status'], 'integer'],
            [['name', 'mail', 'mobile', 'town', 'street', 'house', 'kvoret', 'datemy', 'whentime', 'mobileto', 'textotkr', 'datez'], 'safe'],
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
        $query = Orders::find();

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
            'id' => $this->id,
            'dost' => $this->dost,
            'oplata' => $this->oplata,
            'textcomment' => $this->textcomment,
            'iduser' => $this->iduser,
            'totprice' => $this->totprice,
           
            'datez' => $this->datez,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'mail', $this->mail])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'town', $this->town])
            ->andFilterWhere(['like', 'street', $this->street])
            ->andFilterWhere(['like', 'house', $this->house])
            ->andFilterWhere(['like', 'kvoret', $this->kvoret])
            ->andFilterWhere(['like', 'datemy', $this->datemy])
            ->andFilterWhere(['like', 'whentime', $this->whentime])
            ->andFilterWhere(['like', 'mobileto', $this->mobileto])
            ->andFilterWhere(['like', 'textotkr', $this->textotkr]);

        return $dataProvider;
    }
}
