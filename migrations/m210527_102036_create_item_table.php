<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%item}}`.
 */
class m210527_102036_create_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%item}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull()->comment('Наменование'),
            'group_id' => $this->integer()->notNull()->comment('Группа'),
            'substance_id' => $this->integer()->notNull()->comment('Активное вещество'),
            'dose' => $this->float()->notNull()->comment('Доза'),
            'food_mode' => $this->smallInteger()->defaultValue(1)->comment('Прием с пищей'),
            'per_day' => $this->smallInteger()->defaultValue(1)->comment('Периодичность'),
            'temp_min' => $this->smallInteger()->defaultValue(0)->comment('Минимальная температура'),
            'temp_max' => $this->smallInteger()->defaultValue(25)->comment('Максимальная температура'),
            'content' => $this->text()->comment('Описание'),
            'price' => $this->decimal(10,2)->comment('Стоимость'),
            'amount' => $this->integer()->notNull()->defaultValue(10)->comment('Количество в упаковке'),
            'image' => $this->binary()->defaultValue(null)->comment('Фото'),
        ]);

        $images = [
            file_get_contents('https://cdn.eapteka.ru/upload/offer_photo/326/704/1_9f65988def262d75e21c8c0c8adfcff7.jpeg?_cvc=1622209430'),
            file_get_contents('https://cdn.eapteka.ru/upload/offer_photo/244/657/1_ea5948055b93aaa179045abaa7f6592d.jpeg?_cvc=1622209430'),
            file_get_contents('https://cdn.eapteka.ru/upload/offer_photo/221/413/1_42612abf9e73198a8472ff3652e8462b.jpeg?_cvc=1622209430'),
            file_get_contents('https://cdn.eapteka.ru/upload/offer_photo/276/225/1.jpeg?_cvc=1622209430'),
            file_get_contents('https://cdn.eapteka.ru/upload/offer_photo/250/621/1_582441420dfed6634bdd0b60845dc0b7.jpeg?_cvc=1622209430'),
            file_get_contents('https://cdn.eapteka.ru/upload/offer_photo/274/384/1_4b0b50cec0cd8010e36447c80d1afc3c.jpeg?_cvc=1622209430'),
            file_get_contents('https://cdn.eapteka.ru/upload/offer_photo/326/704/1_9f65988def262d75e21c8c0c8adfcff7.jpeg?_cvc=1622209430'),
            file_get_contents('https://cdn.eapteka.ru/upload/offer_photo/227/442/1_15235a8b8cd2fba34793d0409e7391a3.jpeg?_cvc=1622209430'),
            file_get_contents('https://cdn.eapteka.ru/upload/offer_photo/242/922/1.png?_cvc=1622209430'),
            file_get_contents('https://cdn.eapteka.ru/upload/offer_photo/233/649/1.jpeg?_cvc=1622209430'),
            file_get_contents('https://cdn.eapteka.ru/upload/offer_photo/217/56/1.jpg?_cvc=1622209430'),
            file_get_contents('https://cdn.eapteka.ru/upload/offer_photo/470/145/1_6ec375c7b1e8e6d4667039309413fe3d.jpeg?_cvc=1622209430'),
            file_get_contents('https://cdn.eapteka.ru/upload/offer_photo/338/740/1.jpeg?_cvc=1622209430'),
            file_get_contents('https://cdn.eapteka.ru/upload/offer_photo/498/570/1_a1796e226a46fda3e7a4029b30f104cd.jpeg?_cvc=1622209430'),
            file_get_contents('https://cdn.eapteka.ru/upload/offer_photo/218/724/1_01beaf9a331d77f4a9ed2737937df032.jpeg?_cvc=1622209430'),
            file_get_contents('https://cdn.eapteka.ru/upload/offer_photo/504/868/1_6c750c80564f84fa91ade6ac869d3906.jpeg?_cvc=1622209430'),
        ];

        $this->batchInsert('item', ['name', 'group_id', 'substance_id', 'dose', 'food_mode', 'per_day', 'temp_min', 'temp_max', 'content', 'price', 'amount'], [
            ["Нурофен Экспресс капсулы 200 мг, 8 шт.", 6, 1, 200, 2, 1, 0, 25, "Производитель: Рекитт Бенкизер, Великобритания.
Срок годности: 3 года.", 81.00, 10],
            ["Нурофен, экспресс гель 5% 50 г",6,1,50,1,2,0,25,"Нурофен Экспресс (ибупрофен) гель 5% быстро впитывается, действует прямо на источник боли и оказывает двойное действие – обезболивающее и противовоспалительное

Препарат Нурофен Экспресс в лекарственной форме гель для наружного применения легко наносится и быстро впитывается в кожу.",139.00,10],
            ["Стрепсилс Интенсив, таблетки медово-лимонные, 24 шт",31,2,8.75,3,1,0,25,"Производитель: Рекитт Бенкизер, Великобритания.",234.00,10],
            ["Гевискон, таблетки жевательные мятные 12 шт.",15,3,250,3,3,0,25,"Производитель: Рекитт Бенкизер, Великобритания.",146.00,10],
            ["Нурофен суспензия для детей 100мг/5 мл клубника, 100 мл",6,1,100,2,2,0,25,"Нурофен для детей, суспензия для приема внутрь клубничная, подходит для детей с 3 месяцев до 12 лет*. Борется с жаром и болью, действуя до 8 часов. Суспензия имеет приятный клубничный вкус, не содержит сахара и красителей, а каждый флакон в комплекте с удобным мерным шприцем.

*В зависимости от массы тела ребенка, предусмотренной инструкцией по применению препарата",106.00,10],
            ["Нурофен для детей суспензия 100 мг/5 мл клубника, 200 мл",6,1,100,2,3,0,25,"Производитель: Рекитт Бенкизер, Великобритания.",189.00,10],
            ["Нурофен Экспресс капсулы 200 мг, 24 шт",6,1,200,2,2,0,25,"Производитель: Рекитт Бенкизер, Великобритания.",335.00,10],
            ["Нурофен, таблетки обезболивающие 200 мг, 20 шт.",6,1,200,2,3,0,25,"Производитель: Рекитт Бенкизер, Великобритания.
",140.00,10],
            ["Ибупрофен-Акрихин суспензия 100 мг/5 мл апельсиновая, 100 мл",6,1,100,2,2,0,25,"Производитель: Акрихин ХФК АО, Россия.
",91.00,10],
            ["Ибупрофен, суспензия 100 мг/5 мл, 100 мл",6,1,100,2,2,0,25,"Производитель: Эколаб, Россия.",79.00,10],
            ["Супрастин таблетки 25 мг 20 шт" ,2,4,25,3,3,0,25, "Производитель: Эгис, Венгрия.",127.00,10],
            ["Суприламин таблетки 25 мг, 20 шт",2,4,25,3,3,0,25,"Производитель: Велфарм, Россия.",94.00,10],
            ["Солгар Таурин для котят 500 мг капсулы, 50 шт",11,7,500,1,2,0,25,"Производитель: Солгар, США.

Биологическая добавка Солгар Таурин 500 мг проявляет метаболическое и кардиотоническое действие, способствует расширению сосудов и улучшает доставку кислорода в ткани организма.

Такие свойства препарата успешно используются для повышения физической выносливости и эффективности занятий спортом. Средство применяется в составе комплексного лечения сердечно-сосудистых заболеваний, а также для профилактики их возникновения.

В ходе клинических испытаний доказано, что прием Solgar Taurine 500mg Vegetable Capsules ускоряет восстановление пациентов после перенесенного сердечного приступа или сердечной недостаточности.

вегетарианский продукт
кошерный
без молочных компонентов
без глютена
без пшеницы
без продуктов животного происхождения
без соли
без сахара
без крахмала",822.00,50],
            ["Lysi Рыбий жир со вкусом лосося для котят, 240 мл",11,9,1080,1,1,0,25,"Производитель: ЛИСИ Х.Ф., Исландия.

Рыбий жир с приятным вкусом лосося для котят от исландской компании ЛИСИ - мирового лидера в производстве рыбьего жира.

Жир печени трески бренда ЛИСИ содержит Омега-3 жирные кислоты, оказывающие положительное влияние на работу сердца, работу головного мозга и центральной нервной системы. Витамины А и D способствуют поддержанию здоровья зубов, костей и зрения. Витамин Е обладает антиоксидантным действием, способствует замедлению старения организма, улучшает половую функцию у мужчин и женщин.

Рыбий жир в жидкой форме с приятным вкусом лосося для котят от исландского производителя рыбьего жира. Преимущество:

оптимальное соотношение ДГК и ЭПК;
удобно дозировать;
полный цикл производства на заводе мирового лидера в производстве рыбьего жира компании ЛИСИ;
содержит витамины А, D, Е;
производится только из диких морских рыб.",1979.00,48],
            ["Компливит Кальций Д3 для котят, флакон, 43 г",11,8,200,2,1,0,25,"Фармстандарт-Уфавита, Россия.

",329.00,8],
            ["Офтолик витамины для глаз для котят капсулы, 30 шт",11,11,1,1,1,0,25,"Витамины для глаз \"Офтолик\" - это комплексное действие антиоксидантов и нейропротекторов, обеспечивающее питательную поддержку для развития качества глаз и мозга у котят.",425.00,30],
        ]);



        $tableName = "item";
        $this->addForeignKey("fk_{$tableName}_group_id", $tableName, 'group_id', 'group', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex("idx_{$tableName}_group_id", $tableName, 'group_id');
        $this->addForeignKey("fk_{$tableName}_substance_id", $tableName, 'substance_id', 'substance', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex("idx_{$tableName}_substance_id", $tableName, 'substance_id');

        $items = \app\models\Item::find()->all();
        foreach ($items as $key => $item) {
            $item->image = $images[$key];
            $item->save(true, ['image']);
        }

        $this->createTable('{{%user_store}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->comment('Пользователь'),
            'item_id' => $this->integer()->notNull()->comment('Лекарство'),
            'amount' => $this->integer()->notNull()->defaultValue(1)->comment('Количество'),
            'target_id' => $this->integer()->notNull()->comment('Кто будет принимать'),
            'regular' => $this->boolean()->notNull()->defaultValue(false)->comment('Регулярный прием'),
            'mode' => $this->smallInteger()->notNull()->defaultValue(1)->comment('Вид аптечки'), //дома или в дороге
        ]);

        $tableName = "user_store";
        $this->addForeignKey("fk_{$tableName}_user_id", $tableName, 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex("idx_{$tableName}_user_id", $tableName, 'user_id');
        $this->addForeignKey("fk_{$tableName}_target_id", $tableName, 'target_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex("idx_{$tableName}_target_id", $tableName, 'target_id');
        $this->addForeignKey("fk_{$tableName}_item_id", $tableName, 'item_id', 'item', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex("idx_{$tableName}_item_id", $tableName, 'item_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%item}}');
        $this->dropTable('{{%user_store}}');
    }
}
