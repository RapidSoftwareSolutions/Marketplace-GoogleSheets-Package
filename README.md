[![](https://scdn.rapidapi.com/RapidAPI_banner.png)](https://rapidapi.com/package/GoogleSheets/functions?utm_source=RapidAPIGitHub_GoogleSheetsFunctions&utm_medium=button&utm_content=RapidAPI_GitHub)

# GoogleSheets Package
Read, write, and format data in Sheets. Programmatically create and update pivot tables, data validation, charts and more.
* Domain: https://docs.google.com/spreadsheets
* Credentials: clientId, clientSecret, accessToken

## How to get credentials: 
1. Obtain OAuth 2.0 credentials from the [Google API Console](https://console.developers.google.com/).
2. Send an authentication request to Google
``` 
GET: https://accounts.google.com/o/oauth2/v2/auth
```

|Field|Description|
|-----|-----------|
|client_id|Which you obtain from the API Console.|
|scope|Which in a basic request should be openid email. (Read more at [scope](https://developers.google.com/identity/protocols/OpenIDConnect#scope-param).)|
|response_type|Which in a basic request should be ```code```|
|redirect_uri|Should be the HTTP endpoint on your server that will receive the response from Google. You specify this URI in the API Console.|
3. Call ```getAccessToken``` method.
 
## Custom datatypes:
  |Datatype|Description|Example
  |--------|-----------|----------
  |Datepicker|String which includes date and time|```2016-05-28 00:00:00```
  |Map|String which includes latitude and longitude coma separated|```50.37, 26.56```
  |List|Simple array|```["123", "sample"]```
  |Select|String with predefined values|```sample```
  |Array|Array of objects|```[{"Second name":"123","Age":"12","Photo":"sdf","Draft":"sdfsdf"},{"name":"adi","Second name":"bla","Age":"4","Photo":"asfserwe","Draft":"sdfsdf"}] ```

## GoogleSheets.getAccessToken
Exchange code for access token.

| Field       | Type       | Description
|-------------|------------|----------
| clientId    | credentials| The client ID that you obtain from the API Console, as described in Obtain OAuth 2.0 credentials.
| clientSecret| credentials| The client secret that you obtain from the API Console, as described in Obtain OAuth 2.0 credentials.
| code        | String     | The authorization code that is returned from the initial request.
| redirectUri | String     | The URI that you specify in the API Console, as described in Set a redirect URI.
| grantType   | String     | This field must contain a value of authorization_code, as defined in the OAuth 2.0 specification.

## GoogleSheets.updateSpreadsheet
Applies one or more updates to the spreadsheet.

| Field                       | Type       | Description
|-----------------------------|------------|----------
| accessToken                 | credentials| OAuth 2.0 token for the current user.
| spreadsheetId               | String     | The spreadsheet to apply the updates to.
| requests                    | List       | A list of updates to apply to the spreadsheet. Requests will be applied in the order they are specified. If any request is not valid, no requests will be applied.
| includeSpreadsheetInResponse| Select     | Determines if the update response should include the spreadsheet resource.
| responseIncludeGridData     | Select     | True if grid data should be returned. Meaningful only if if includeSpreadsheetResponse is 'true'. This parameter is ignored if a field mask was set in the request.
| responseRanges              | List       | Limits the ranges included in the response spreadsheet. Meaningful only if includeSpreadsheetResponse is 'true'.
request example:
```
"requests": 
[
    {
        "sortRange":
        {
            "range": 
            {
                "endColumnIndex": 5,
                "endRowIndex": 5,
                "sheetId": 0,
                "startColumnIndex": 0,
                "startRowIndex": 0
            }
        }
    }
]
```
[Request object description](https://developers.google.com/sheets/api/reference/rest/v4/spreadsheets/request#Request)

## GoogleSheets.createSpreadsheet
Creates a spreadsheet, returning the newly created spreadsheet.

| Field      | Type       | Description
|------------|------------|----------
| accessToken| credentials| OAuth 2.0 token for the current user.
| properties | JSON       | Overall properties of a spreadsheet.
| sheets     | List       | The sheets that are part of a spreadsheet.
| namedRanges| List       | The named ranges defined in a spreadsheet.

```
"properties": 
{
    "title": "newTable"
}
```
[Fields description](https://developers.google.com/sheets/api/reference/rest/v4/spreadsheets#Spreadsheet)


## GoogleSheets.getSingleSpreadsheet
Returns the spreadsheet at the given ID. The caller must specify the spreadsheet ID.

| Field          | Type       | Description
|----------------|------------|----------
| accessToken    | credentials| OAuth 2.0 token for the current user.
| spreadsheetId  | String     | The spreadsheet to request.
| ranges         | String     | The ranges to retrieve from the spreadsheet.
| includeGridData| Select     | True if grid data should be returned. This parameter is ignored if a field mask was set in the request.

## GoogleSheets.copySheets
Copies a single sheet from a spreadsheet to another spreadsheet. Returns the properties of the newly created sheet.

| Field                   | Type       | Description
|-------------------------|------------|----------
| accessToken             | credentials| OAuth 2.0 token for the current user.
| spreadsheetId           | String     | The ID of the spreadsheet containing the sheet to copy.
| sheetId                 | String     | The ID of the sheet to copy.
| destinationSpreadsheetId| String     | The ID of the spreadsheet to copy the sheet to.

## GoogleSheets.appendSheetValues
Appends values to a spreadsheet. The input range is used to search for existing data and find a `table` within that range. Values will be appended to the next row of the table, starting with the first column of the table.

| Field                       | Type       | Description
|-----------------------------|------------|----------
| accessToken                 | credentials| OAuth 2.0 token for the current user.
| spreadsheetId               | String     | The ID of the spreadsheet to update.
| range                       | String     | The A1 notation of a range to search for a logical table of data. Values will be appended after the last row of the table.
| valueInputOption            | Select     | How the input data should be interpreted. Must be: INPUT_VALUE_OPTION_UNSPECIFIED,RAW,USER_ENTERED
| insertDataOption            | Select     | How the input data should be inserted. Must be: OVERWRITE,INSERT_ROWS
| includeValuesInResponse     | Select     | Determines if the update response should include the values of the cells that were appended. By default, responses do not include the updated values.
| responseValueRenderOption   | Select     | Determines how values in the response should be rendered. Must be: FORMATTED_VALUE,UNFORMATTED_VALUE,FORMULA
| responseDateTimeRenderOption| Select     | Determines how dates, times, and durations in the response should be rendered. Must be: SERIAL_NUMBER,FORMATTED_STRING
| valueRange                  | JSON       | ValueRange structure.


valueRange example:
```
"valueRange":
{
    "range": "A1:C10",
    "majorDimension": "ROWS",
    "values":
    [
		    
    ]
}
```
For more details, read [description.](https://developers.google.com/sheets/api/reference/rest/v4/spreadsheets.values#ValueRange)

## GoogleSheets.batchClear
Clears one or more ranges of values from a spreadsheet.   

| Field        | Type       | Description
|--------------|------------|----------
| accessToken  | credentials| OAuth 2.0 token for the current user.
| spreadsheetId| String     | The ID of the spreadsheet to update.
| ranges       | List       | The ranges to clear, in A1 notation.
A1 notation:
``` 
A1:C10
```
## GoogleSheets.getBatchValues
Returns one or more ranges of values from a spreadsheet. The caller must specify the spreadsheet ID and one or more ranges.

| Field               | Type       | Description
|---------------------|------------|----------
| accessToken         | credentials| OAuth 2.0 token for the current user.
| spreadsheetId       | String     | The ID of the spreadsheet to retrieve data from.
| ranges              | String     | The A1 notation of the values to retrieve.
| majorDimension      | Select     | The major dimension that results should use. Must be: DIMENSION_UNSPECIFIED, ROWS, COLUMNS
| valueRenderOption   | Select     | How values should be represented in the output. Must be: FORMATTED_VALUE, UNFORMATTED_VALUE, FORMULA
| dateTimeRenderOption| Select     | How dates, times, and durations should be represented in the output. Must be: SERIAL_NUMBER, FORMATTED_STRING

## GoogleSheets.batchUpdate
Sets values in one or more ranges of a spreadsheet.

| Field                       | Type       | Description
|-----------------------------|------------|----------
| accessToken                 | credentials| OAuth 2.0 token for the current user.
| spreadsheetId               | String     | The ID of the spreadsheet to update.
| valueInputOption            | Select     | How the input data should be interpreted. Must be: INPUT_VALUE_OPTION_UNSPECIFIED, RAW, USER_ENTERED
| data                        | JSON       | The new values to apply to the spreadsheet.
| includeValuesInResponse     | Select     | Determines if the update response should include the values of the cells that were updated. true or false
| responseValueRenderOption   | Select     | Determines how values in the response should be rendered. Must be: FORMATTED_VALUE, UNFORMATTED_VALUE, FORMULA
| responseDateTimeRenderOption| Select     | Determines how dates, times, and durations in the response should be rendered. Must be: SERIAL_NUMBER, FORMATTED_STRING
data example: 
``` 
"data":
{
    "range": "A1:C11",
    "majorDimension": "ROWS",
    "values": []
}
```
[Read more](https://developers.google.com/sheets/api/reference/rest/v4/spreadsheets.values#ValueRange)

## GoogleSheets.clearValues
Clears values from a spreadsheet. The caller must specify the spreadsheet ID and range. Only values are cleared -- all other properties of the cell (such as formatting, data validation, etc..) are kept.

| Field        | Type       | Description
|--------------|------------|----------
| accessToken  | credentials| OAuth 2.0 token for the current user.
| spreadsheetId| String     | The ID of the spreadsheet to update.
| range        | String     | The A1 notation of the values to clear.
A1 notation:
``` 
A1:C10
```

## GoogleSheets.getRangeValues
Returns a range of values from a spreadsheet. The caller must specify the spreadsheet ID and a range.

| Field               | Type       | Description
|---------------------|------------|----------
| accessToken         | credentials| OAuth 2.0 token for the current user.
| spreadsheetId       | String     | The ID of the spreadsheet to retrieve data from.
| range               | String     | The A1 notation of the values to retrieve.
| majorDimension      | Select     | The A1 notation of the values to retrieve. Must be: DIMENSION_UNSPECIFIED, ROWS, COLUMNS
| valueRenderOption   | Select     | How values should be represented in the output. Must be: FORMATTED_VALUE, UNFORMATTED_VALUE, FORMULA
| dateTimeRenderOption| Select     | How dates, times, and durations should be represented in the output. Must be: SERIAL_NUMBER, FORMATTED_STRING

## GoogleSheets.updateRangeValues
Sets values in a range of a spreadsheet.

| Field                       | Type       | Description
|-----------------------------|------------|----------
| accessToken                 | credentials| OAuth 2.0 token for the current user.
| spreadsheetId               | String     | The ID of the spreadsheet to update.
| range                       | String     | The A1 notation of the values to update.
| valueInputOption            | Select     | How the input data should be interpreted. Must be: INPUT_VALUE_OPTION_UNSPECIFIED, RAW, USER_ENTERED
| includeValuesInResponse     | Select     | Determines if the update response should include the values of the cells that were updated.
| responseValueRenderOption   | Select     | Determines how values in the response should be rendered. Must be: FORMATTED_VALUE, UNFORMATTED_VALUE, FORMULA
| responseDateTimeRenderOption| Select     | Determines how dates, times, and durations in the response should be rendered. Must be: SERIAL_NUMBER, FORMATTED_STRING
| value                       | JSON       | Data within a range of the spreadsheet.

A1 notation:
``` 
A1:C10
```
value example: 
``` 
"value":
{
    "range": "A1:C11",
    "majorDimension": "ROWS",
    "values": []
}
```
[Read more](https://developers.google.com/sheets/api/reference/rest/v4/spreadsheets.values#ValueRange)



