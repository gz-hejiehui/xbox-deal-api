<?php

namespace GzHejiehui\XboxDealApi\Tests;

final class FakeData
{
    const CHANNEL_LIST_COMMON_RESULT_JSON = '{"Id":"Lists","Name":"Lists","Version":"v8.0","ContinuationToken":"d7cb65b4-45f0-40af-b3b4-ad3be9596f5f","Items":[{"Id":"9MWWNMH6Z0JH","ItemType":"Game","PredictedScore":1.0,"TrackingId":"00000000-0000-0000-0000-000000000003"},{"Id":"BT5P2X999VH2","ItemType":"Game","PredictedScore":2.0,"TrackingId":"00000000-0000-0000-0000-000000000003"},{"Id":"9PGPQK0XTHRZ","ItemType":"Game","PredictedScore":3.0,"TrackingId":"00000000-0000-0000-0000-000000000003"},{"Id":"BV9ML45J2Q5V","ItemType":"Game","PredictedScore":4.0,"TrackingId":"00000000-0000-0000-0000-000000000003"},{"Id":"BQ1TN1T79V9K","ItemType":"Game","PredictedScore":5.0,"TrackingId":"00000000-0000-0000-0000-000000000003"},{"Id":"C125W9BG2K0V","ItemType":"Game","PredictedScore":6.0,"TrackingId":"00000000-0000-0000-0000-000000000003"},{"Id":"C0MN5DN8KR3F","ItemType":"Game","PredictedScore":7.0,"TrackingId":"00000000-0000-0000-0000-000000000003"},{"Id":"9NZQPT0MWTD0","ItemType":"Game","PredictedScore":8.0,"TrackingId":"00000000-0000-0000-0000-000000000003"},{"Id":"9PP5G1F0C2B6","ItemType":"Game","PredictedScore":9.0,"TrackingId":"00000000-0000-0000-0000-000000000003"},{"Id":"9PF432CVQBXT","ItemType":"Game","PredictedScore":10.0,"TrackingId":"00000000-0000-0000-0000-000000000003"}],"Title":"熱門免費遊戲","LongTitle":"熱門免費遊戲","PagingInfo":{"TotalItems":116},"Status":"Success"}';
    const CHANNEL_LIST_EMPTY_RESULT_JSON = '{"Id":"Lists","Name":"Lists","Version":"v8.0","ContinuationToken":"e736c619-4a67-424e-991b-30679a1f3c78","Items":[],"Title":"清單","LongTitle":"清單","PagingInfo":{"TotalItems":0},"Status":"DataDoesNotExist","Details":"The requested list was not cooked in the Reco offline cooking process"}';
}
