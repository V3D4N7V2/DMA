SELECT tblsongs.songName,
    tblsongs.ISBNNumber,
    tblissuedsongdetails.IssuesDate,
    tblissuedsongdetails.ReturnDate,
    tblissuedsongdetails.id as rid,
    tblissuedsongdetails.fine
from tblissuedsongdetails
    join tblstudents on tblstudents.StudentId = tblissuedsongdetails.StudentId
    join tblsongs on tblsongs.id = tblissuedsongdetails.songId
where tblstudents.StudentId = :sid
order by tblissuedsongdetails.id desc;