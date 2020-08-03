Attribute VB_Name = "Module1"
Dim wb As Workbook
Dim sht As Worksheet
Dim rng As Range
Dim maxCount As Long


Public Function findUnit(item As String) As String
If item = "" Then findUnit = "999999": Exit Function

Set wb = ThisWorkbook
Set sht = wb.Sheets("units")

maxCount = sht.Cells.Find("*", Searchorder:=xlByRows, SearchDirection:=xlPrevious).Row

Set rng = sht.Range("B1:B" & maxCount).Find(What:=item, LookAt:=xlWhole, MatchCase:=False, SearchFormat:=False)

If Not rng Is Nothing Then
    findUnit = rng.Offset(0, -1).Value
Else
    findUnit = "999999"
End If
End Function

Public Function findDeviceType(item As String) As String
If item = "" Then findDeviceType = "1": Exit Function

Set wb = ThisWorkbook
Set sht = wb.Sheets("device_types")

maxCount = sht.Cells.Find("*", Searchorder:=xlByRows, SearchDirection:=xlPrevious).Row

Set rng = sht.Range("B1:B" & maxCount).Find(What:=item, LookAt:=xlWhole, MatchCase:=False, SearchFormat:=False)

If Not rng Is Nothing Then
    findDeviceType = rng.Offset(0, -1).Value
Else
    findDeviceType = "1"
End If
End Function


Public Function findPosition(item As String) As String
If item = "" Then findPosition = "999999": Exit Function

Set wb = ThisWorkbook
Set sht = wb.Sheets("positions")

maxCount = sht.Cells.Find("*", Searchorder:=xlByRows, SearchDirection:=xlPrevious).Row

Set rng = sht.Range("B1:B" & maxCount).Find(What:=item, LookAt:=xlWhole, MatchCase:=False, SearchFormat:=False)

If Not rng Is Nothing Then
    findPosition = rng.Offset(0, -1).Value
Else
    findPosition = "999999"
End If
End Function

Public Function findUser(item As String) As String
If item = "" Then findUser = "11": Exit Function

Set wb = ThisWorkbook
Set sht = wb.Sheets("users")

maxCount = sht.Cells.Find("*", Searchorder:=xlByRows, SearchDirection:=xlPrevious).Row

Set rng = sht.Range("B1:B" & maxCount).Find(What:=item, LookAt:=xlWhole, MatchCase:=False, SearchFormat:=False)

If Not rng Is Nothing Then
    findUser = rng.Offset(0, -1).Value
Else
    findUser = "999999"
End If
End Function

Public Function findLubricationType(item As String) As String
If item = "" Then findLubricationType = "99": Exit Function

Set wb = ThisWorkbook
Set sht = wb.Sheets("lubrication_type")

maxCount = sht.Cells.Find("*", Searchorder:=xlByRows, SearchDirection:=xlPrevious).Row

Set rng = sht.Range("B1:B" & maxCount).Find(What:=item, LookAt:=xlWhole, MatchCase:=False, SearchFormat:=False)

If Not rng Is Nothing Then
    findLubricationType = rng.Offset(0, -1).Value
Else
    findLubricationType = "99"
End If
End Function

Public Function findLubricationActivity(item As String) As String
If item = "" Then findLubricationActivity = "99": Exit Function

Set wb = ThisWorkbook
Set sht = wb.Sheets("lubrication_activities")

maxCount = sht.Cells.Find("*", Searchorder:=xlByRows, SearchDirection:=xlPrevious).Row

Set rng = sht.Range("B1:B" & maxCount).Find(What:=item, LookAt:=xlWhole, MatchCase:=False, SearchFormat:=False)

If Not rng Is Nothing Then
    findLubricationActivity = rng.Offset(0, -1).Value
Else
    findLubricationActivity = "99"
End If
End Function

Public Function findLubricationPoint(item As String) As String
If item = "" Then findLubricationPoint = "9999999": Exit Function

Set wb = ThisWorkbook
Set sht = wb.Sheets("lubrication_points")

maxCount = sht.Cells.Find("*", Searchorder:=xlByRows, SearchDirection:=xlPrevious).Row

Set rng = sht.Range("C1:C" & maxCount).Find(What:=item, LookAt:=xlWhole, MatchCase:=False, SearchFormat:=False)

If Not rng Is Nothing Then
    findLubricationPoint = rng.Offset(0, -2).Value
Else
    findLubricationPoint = "9999999"
End If
End Function

Public Function findWorkOrder(item As String) As String
If item = "" Then findWorkOrder = "9999999": Exit Function

Set wb = ThisWorkbook
Set sht = wb.Sheets("work_orders")

maxCount = sht.Cells.Find("*", Searchorder:=xlByRows, SearchDirection:=xlPrevious).Row

Set rng = sht.Range("B1:B" & maxCount).Find(What:=item, LookAt:=xlWhole, MatchCase:=False, SearchFormat:=False)

If Not rng Is Nothing Then
    findWorkOrder = rng.Offset(0, -1).Value
Else
    findWorkOrder = "9999999"
End If
End Function



