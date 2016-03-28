<?php
/**
 * Created by phpNT.
 * User: phpNT
 * Date: 01.03.2016
 * Time: 11:12
 */

namespace common\models;

use frontend\modules\terminals\models\TTerminal;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class TTerminalSearch  extends TTerminal
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_feature'], 'integer'],
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
        $query = TTerminal::find()
            ->where(['is_feature' => true]) 
            ->orderBy([
                'id_terminal' => SORT_DESC]);;

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 9,
            ],
            /*'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                    'title' => SORT_ASC,
                ]
            ],*/
        ]);
		
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        /*$query->andFilterWhere([
            'is' => $this->id,
        ]);*/

        return $dataProvider;
    }
}