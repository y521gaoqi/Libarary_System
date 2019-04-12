books<-subset(books,select=-V2)
books
write.csv(books,"/Users/qigao/Desktop/book_modifed.csv",row.names = FALSE)

books<-books[,-c(3:6)]
books<-books[-1,]
names(books)<-c("Isbn","Title")
write.csv(books,"/Users/qigao/Desktop/book_modifed.csv",row.names = FALSE)
