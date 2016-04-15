<?php
/**
 * Created by phpNT.
 * User: phpNT
 * Date: 29.02.2016
 * Time: 13:30
 */

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class TOfficeSearch extends TOffice
{
    public $id_city;
    public $category;
    public $title;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_spr', 'id_city', 'category'], 'integer'],
            ['title', 'string']
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
        $query = TOffice::find()
            ->where(['is_spr' => true])
            ->joinWith(['categories'])
            ->orderBy([
                't_office.id_office' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 18,
            ],
        ]);

        $this->load($params);

        $query->andFilterWhere([
            'id_city' => $this->id_city,
            'id_category' => $this->category,
            'user' => $this->user
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);


        /*$this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }*/

        return $dataProvider;
    }
}