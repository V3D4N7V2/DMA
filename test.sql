SELECT tblbooks.BookName,
    tblbooks.ISBNNumber,
    tblissuedbookdetails.IssuesDate,
    tblissuedbookdetails.ReturnDate,
    tblissuedbookdetails.id as rid,
    tblissuedbookdetails.fine
from tblissuedbookdetails
    join tblstudents on tblstudents.StudentId = tblissuedbookdetails.StudentId
    join tblbooks on tblbooks.id = tblissuedbookdetails.BookId
where tblstudents.StudentId = :sid
order by tblissuedbookdetails.id desc;