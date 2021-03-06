<?php

namespace app\modules\doman\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\doman\models\Licenca;

/**
 * LicencaSearch represents the model behind the search form about `app\modules\doman\models\Licenca`.
 */
class LicencaSearch extends Licenca
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'educador_id', 'tipo', 'status', 'user_id'], 'integer'],
            [['data_inicio', 'data_fim', 'data_criacao', 'identificador'], 'safe'],
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
        $query = Licenca::find()->where(['deletado'=>false]);

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
            'educador_id' => $this->educador_id,
            'data_inicio' => $this->data_inicio,
            'data_fim' => $this->data_fim,
            'data_criacao' => $this->data_criacao,
            'tipo' => $this->tipo,
            'status' => $this->status,
            'user_id' => $this->user_id,
            'deletado' => $this->deletado,
        ]);

        $query->andFilterWhere(['like', 'identificador::"varchar"', $this->identificador]);

        return $dataProvider;
    }
}
