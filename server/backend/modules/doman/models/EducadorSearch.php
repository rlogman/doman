<?php

namespace app\modules\doman\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\doman\models\Educador;

/**
 * EducadorSearch represents the model behind the search form about `app\modules\doman\models\Educador`.
 */
class EducadorSearch extends Educador
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tipo', 'status', 'user_id'], 'integer'],
            [['nome', 'email', 'data_criacao'], 'safe'],
            [['deletado'], 'boolean'],
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
        $query = Educador::find()->where(['deletado' => false]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['nome' => SORT_ASC, 'id' => SORT_DESC]]
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
            'tipo' => $this->tipo,
            'status' => $this->status,
            'user_id' => $this->user_id,
            'data_criacao' => $this->data_criacao,
            'deletado' => $this->deletado,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
