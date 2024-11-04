<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DocUploaded;
use yii\db\Query;
use yii\data\ArrayDataProvider;
/**
 * DocSearch represents the model behind the search form of `app\models\DocUploaded`.
 */
class DocSearch extends DocUploaded
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_doc', 'user_id'], 'integer'],
            [['file_name', 'datetime'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = (new Query())
            ->select([
                'username' => 'user.username',
                'file_name' => 'doc_uploaded.file_name',
                'datetime' => 'doc_uploaded.datetime',
                'id_doc' => 'doc_uploaded.id_doc',
            ])
            ->from('doc_uploaded')
            ->leftJoin('user', 'doc_uploaded.user_id = user.id')
            ->groupBy('doc_uploaded.id_doc');

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
            'id_doc' => $this->id_doc,
            'datetime' => $this->datetime,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'file_name', $this->file_name]);


        $command = $query->createCommand();
        $results = $command->queryAll();
        
        return new ArrayDataProvider([
            'allModels' => $results,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
    }
}
