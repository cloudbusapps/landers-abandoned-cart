***** REQUEST/PAYLOAD *****
----- METHOD
POST

----- ENDPOINT
test.com/index.php

----- HEADERS
Content-Type: application/json
journey_builder_id: 233c3a4d16-82d4-4ce2-b2db-17fb44cc9c8b
event_definition_key: APIEvent-839ac22d-1063-4774-8d19-52ba77c1adb4

----- BODY
{
    "label": "Campaign SCS",
    "data": [
        {
            "membership_id": "1020123512332",
            "full_name": "John Doe",
            "email_address": "johndoe@email.com",
            "mobile_number": "0999999999",
            "product_name": "Yoghurt Tasty",
            "product_image_url": "https://img.freepik.com/free-vector/realistic-yogurt-advertisement_52683-8155.jpg"
        },
        {
            "membership_id": "1020123512332",
            "full_name": "John Doe",
            "email_address": "johndoe@email.com",
            "mobile_number": "0999999999",
            "product_name": "Yoghurt Tasty",
            "product_image_url": "https://img.freepik.com/free-vector/realistic-yogurt-advertisement_52683-8155.jpg"
        }
    ]
}
LIMIT 200
REQUIRED: subcriber_key, email_address

***** RESPONSE *****
{
    "status": "Success|Failed|Partial Success",
    "message": "API Event processing completed successfully|API Event processing failed",
    "data" : {
        "total_count": 10,
        "success_count": 10,
        "failed_count": 0,
        "errors": [
            {
                "email_address": "johndoe@gmail.com",
                "error_message": "Required Event Data fields are missing: [fields]"
            }
        ]
    },
    "execution": {
        "started": "2023-01-01 01:00:00",
        "finished": "2023-01-01 01:10:00",
        "duration": "10m"
    }
}

***** REFERENCE *****
Examples of hard errors include being on the (Auto-) Suppression List, domain exclusion, List Detective exclusion, invalid email address, or empty email address.

Journey Columns - Status,DefinitionId,DefinitionName,ActivityId,ActivityName,ActivityType
https://developer.salesforce.com/docs/marketing/marketing-cloud/guide/downloadJourneyHistory.html