<?php

namespace App\Models\StaticData;

class LootSources
{
    public const CHICKEN_ID = 'bb4208f9-e957-4f54-a732-bb5871fd1fd6';
    public const CHICKEN_NAME = 'Chicken';
    //
    public const GENERAL_GRAARDOOR_ID = '399775d6-4c1e-4d6f-b3d6-d841ff95ec26';
    public const GENERAL_GRAARDOOR_NAME = 'General Graardor';
    //
    public const KRIL_TSUROTH_ID = '29447f51-cb2b-4d9c-ab4d-fdfc2b60ca49';
    public const KRIL_TSUROTH_NAME = 'Kril';
    //
    public const COMMAND_ZILYANA_ID = '4cbd53ae-5752-4555-98e9-0b7d3856117d';
    public const COMMAND_ZILYANA_NAME = 'Commander Zilyana';
    //
    public const KREEARRA_ID = '7112572f-39e7-4b81-a3e1-2a8acd7452a2';
    public const KREEARRA_NAME = 'Kreearra';
    //
    public const GIANT_MOLE_ID = '2b5ba50d-5c59-4cca-9930-77b01be16b31';
    public const GIANT_MOLE_NAME = 'Giant Mole';
    //
    public const KALPHITE_QUEEN_ID = '45a86aa4-c77f-4e6a-b467-115dbb47a3ec';
    public const KALPHITE_QUEEN_NAME = 'Kalphite Queen';
    //
    public const CORPOREAL_BEAST_ID = '5e231bc8-0c65-4715-a669-d69fa87041b1';
    public const CORPOREAL_BEAST_NAME = 'Corporeal Beast';
    //
    public const ZULRAH_ID = '05a77cc1-10a8-4cb0-92f0-12547609d852';
    public const ZULRAH_NAME = 'Zulrah';
    //
    public const VORKATH_ID = '2c843db3-43a1-4848-b366-f68bcddebefe';
    public const VORKATH_NAME = 'Vorkath';
    //
    public const DAGANNOTH_REX_ID = '0223c364-54f4-4c1a-9782-ca8c7ba0789a';
    public const DAGANNOTH_REX_NAME = 'Dagannoth Rex';
    //
    public const DAGANNOTH_SUPREME_ID = 'aafa85fe-c76c-4319-82e7-9f845e30be87';
    public const DAGANNOTH_SUPREME_NAME = 'Dagannoth Supreme';
    //
    public const DAGANNOTH_PRIME_ID = '2ed89a6b-1920-4259-86ed-5c2d158835e3';
    public const DAGANNOTH_PRIME_NAME = 'Dagannoth Prime';
    //
    public const BARROWS_ID = '665309e6-3ccc-49a1-b75b-37c938c0b7e0';
    public const BARROWS_NAME = 'Barrows';
    //
    public const BEGINNER_CLUE_ID = '137c8e86-a061-44ad-9149-7fb6fce3769a';
    public const BEGINNER_CLUE_NAME = 'Beginner Clue';
    //
    public const EASY_CLUE_ID = 'd1c725ae-b910-454d-ae0e-baae97ab06c8';
    public const EASY_CLUE_NAME = 'Easy Clue';
    //
    public const MEDIUM_CLUE_ID = '4af0931f-d869-4d88-b28a-c7500a4aa11b';
    public const MEDIUM_CLUE_NAME = 'Medium Clue';
    //
    public const HARD_CLUE_ID = '70478b86-1c8a-4912-8da5-b1231b89ddaf';
    public const HARD_CLUE_NAME = 'Hard Clue';
    //
    public const ELITE_CLUE_ID = '036efec4-9d9c-4d43-b9a1-e5da80d0f270';
    public const ELITE_CLUE_NAME = 'Elite Clue';
    //
    public const MASTER_CLUE_ID = 'f892b7c3-f03d-433d-bb0d-a02dc760e9d5';
    public const MASTER_CLUE_NAME = 'Master Clue';
    //
    public const CHAMBERS_OF_XERIC_ID = '26b5c3c0-285c-4e94-8a7d-96f52ca183d6';
    public const CHAMBERS_OF_XERIC_NAME = 'Chambers of Xeric';
    //
    public const THEATRE_OF_BLOOD_ID = 'aadc455a-80f0-488f-8756-2c1d90170076';
    public const THEATRE_OF_BLOOD_NAME = 'Theatre of Blood';
    //
    public const TOMBS_OF_AMASCUT_ID = '2d31c90a-b449-442d-a63d-6faf82e6bd1b';
    public const TOMBS_OF_AMASCUT_NAME = 'Tombs of Amascut';
    //
    public const ARTIO_ID = '026d27e2-b896-4d94-a879-5c553420bdfb';
    public const ARTIO_NAME = 'Artio';
    //
    public const CALLISTO_ID = '597fa868-e0ca-414a-8439-e1064e733d7e';
    public const CALLISTO_NAME = 'Callisto';
    //
    public const SPINDEL_ID = '82598013-b723-4bdd-bb57-71bef1f3820f';
    public const SPINDEL_NAME = 'Spindel';
    //
    public const VENENATIS_ID = 'e6508046-b997-4c0c-8e91-f596b256373b';
    public const VENENATIS_NAME = 'Venenatis';

    public function data(): array
    {
        return [
            [
                'id' => self::CHICKEN_ID,
                'name' => self::CHICKEN_NAME,
                'enabled' => false,
            ],
            [
                'id' => self::GENERAL_GRAARDOOR_ID,
                'name' => self::GENERAL_GRAARDOOR_NAME,
            ],
            [
                'id' => self::KRIL_TSUROTH_ID,
                'name' => self::KRIL_TSUROTH_NAME,
            ],
            [
                'id' => self::COMMAND_ZILYANA_ID,
                'name' => self::COMMAND_ZILYANA_NAME,
            ],
            [
                'id' => self::KREEARRA_ID,
                'name' => self::KREEARRA_NAME,
            ],
            [
                'id' => self::GIANT_MOLE_ID,
                'name' => self::GIANT_MOLE_NAME,
            ],
            [
                'id' => self::KALPHITE_QUEEN_ID,
                'name' => self::KALPHITE_QUEEN_NAME,
            ],
            [
                'id' => self::CORPOREAL_BEAST_ID,
                'name' => self::CORPOREAL_BEAST_NAME,
            ],
            [
                'id' => self::ZULRAH_ID,
                'name' => self::ZULRAH_NAME,
            ],
            [
                'id' => self::VORKATH_ID,
                'name' => self::VORKATH_NAME,
            ],
            [
                'id' => self::DAGANNOTH_REX_ID,
                'name' => self::DAGANNOTH_REX_NAME,
                'enabled' => false,
            ],
            [
                'id' => self::DAGANNOTH_SUPREME_ID,
                'name' => self::DAGANNOTH_SUPREME_NAME,
                'enabled' => false,
            ],
            [
                'id' => self::DAGANNOTH_PRIME_ID,
                'name' => self::DAGANNOTH_PRIME_NAME,
                'enabled' => false,
            ],
            [
                'id' => self::BARROWS_ID,
                'name' => self::BARROWS_NAME,
            ],
            [
                'id' => self::BEGINNER_CLUE_ID,
                'name' => self::BEGINNER_CLUE_NAME,
            ],
            [
                'id' => self::EASY_CLUE_ID,
                'name' => self::EASY_CLUE_NAME,
            ],
            [
                'id' => self::MEDIUM_CLUE_ID,
                'name' => self::MEDIUM_CLUE_NAME,
            ],
            [
                'id' => self::HARD_CLUE_ID,
                'name' => self::HARD_CLUE_NAME,
            ],
            [
                'id' => self::ELITE_CLUE_ID,
                'name' => self::ELITE_CLUE_NAME,
            ],
            [
                'id' => self::MASTER_CLUE_ID,
                'name' => self::MASTER_CLUE_NAME,
            ],
            [
                'id' => self::CHAMBERS_OF_XERIC_ID,
                'name' => self::CHAMBERS_OF_XERIC_NAME,
            ],
            [
                'id' => self::THEATRE_OF_BLOOD_ID,
                'name' => self::THEATRE_OF_BLOOD_NAME,
            ],
            [
                'id' => self::TOMBS_OF_AMASCUT_ID,
                'name' => self::TOMBS_OF_AMASCUT_NAME,
            ],
            [
                'id' => self::ARTIO_ID,
                'name' => self::ARTIO_NAME,
                'enabled' => true,
            ],
            [
                'id' => self::CALLISTO_ID,
                'name' => self::CALLISTO_NAME,
            ],
            [
                'id' => self::SPINDEL_ID,
                'name' => self::SPINDEL_NAME,
                'enabled' => true,
            ],
            [
                'id' => self::VENENATIS_ID,
                'name' => self::VENENATIS_NAME,
            ],
        ];
    }
}
