###############################################################                                                           #
#            Random Forest for Classification                 #
###############################################################
#                                                             #
# Train and Test Random Forest for Classification             #
#                                                             #
# This script do the following:                               #
# 1. Load the Data                                            #
# 2. Partition the data into Train/Test set                   #
# 3. Train the Random forest Model                            #
# 4. Test                                                     #
# 5. Evaluate on : Accuracy.                                  # 
# 6. Finally Saving the results.                              #
#                                                             #
###############################################################
# This is a project that I did in my undergrad as an intern under CRIE club at MIET Jammu

#--------------------------------------------------------------
# Step 1: Include Library
#--------------------------------------------------------------
cat("\nStep 1: Library Inclusion")
library(randomForest)  # for building a training model
library(hmeasure) #for model evaluation 
library(ggplot2)  #for data visulization
library(lattice)  #for data visulization
library(caret)    # for cross validation and model evatuation
library(car)
library(RMySQL)	  # for database connection

args <- commandArgs(TRUE)
N <- args[1]
#--------------------------------------------------------------
# Step 2: Variable Declaration
#--------------------------------------------------------------
cat("\nStep 2: Variable Declaration")
modelName <- "randomForest"
modelName


con <- dbConnect(MySQL(), user='admin', password='****', host='localhost',dbname = 'p_analytics')

dbListTables(con)
dbListFields(con,"batch_2010_2012")
dataset <- dbReadTable(con,"batch_2010_2012")
dataset

dataset <- dataset[sample(nrow(dataset)),]  # Shuffle the data row wise.

head(dataset)   # Show Top 6 records
nrow(dataset)   # Show number of records
names(dataset)  # Show fields names or columns


#Whether a variable is categorical or ordinal is to be checked and used in the Model
options(digits = 4)
dataset$FatherOccup <- as.numeric(factor(dataset$FatherOccup, levels = c('Government Employee','Private employee','Businessman','Senior Executive Manager (J&K Bank)','Bank Clerk','Animal Husbandary','Orphan','SO')))
dataset$MotherOccup <- as.numeric(factor(dataset$MotherOccup, levels = c('House wife','Government employee','Private employee','House Maid','Businesswoman','Accountant MIER','Head Master')))
dataset$Board_10 <- as.numeric(factor(dataset$Board_10, levels = c('CBSE','J & K','Maharashtra','CISCE','Punjab','Meghalaya','Other')))
dataset$Marks_Grade_10 <- as.numeric(dataset$Marks_Grade_10)
dataset$Board_12 <- as.numeric(factor(dataset$Board_12, levels = c('CBSE','J & K','Karnataka','National Open School','Other')))
dataset$Marks_Grade_12 <- as.numeric(dataset$Marks_Grade_12)
dataset$Entrance_Score <- as.numeric(dataset$Entrance_Score)
dataset$Batch <- factor(dataset$Batch)
dataset$Dept <- as.numeric(factor(dataset$Dept, levels = c('CSE','MBA','MCA','EE','IT','ECE','CIVIL')))
dataset$SkillIndex <- as.numeric(dataset$SkillIndex)
dataset$Placed <- factor(dataset$Placed, levels = c('Y','N'))
dataset[is.na(dataset)] <-0 #all na values are taken as zero


# Data Normalization function

normalize <- function(df, cols) {
  result <- df # make a copy of the input data frame
  
  for (j in cols) { # each specified col
    mini <- min(df[,j]) # column min
    maxi <- max(df[,j]) # column max
    
    for (i in 1:nrow(result)) { # each row of cur col
      result[i,j] <- (result[i,j] - mini) / (maxi-mini)
    }
  }
  return(result)
}
cols <- c(5,7,8)

dataset.normal <- normalize(dataset, cols)
cat("\nNormalized data frame:\n")
print(dataset.normal, digits=3)

#--------------------------------------------------------------
# Step 4: Count total number of observations/rows.
#--------------------------------------------------------------
cat("\nStep 4: Counting dataset")
totalDataset <- nrow(dataset.normal)
totalDataset

#--------------------------------------------------------------
# Step 5: Choose Target variable
#--------------------------------------------------------------
cat("\nStep 5: Choose Target Variable")
target  <- names(dataset.normal)[13]   # i.e. Placed
target

#--------------------------------------------------------------
# Step 6: Choose inputs Variables
#--------------------------------------------------------------
cat("\nStep 6: Choose Inputs Variable")
Factors <- c('FatherOccup', 'MotherOccup', 'Board_10', 'Marks_Grade_10', 'Board_12', 'Marks_Grade_12', 'Entrance_Score', 'Dept')
Factors
length(Factors)

#--------------------------------------------------------------
# Step 7: Select Testing Data Set
#--------------------------------------------------------------
cat("\nStep 7: Select testing dataset")
Predict_Dataset <- dbReadTable(con,"batch_2014_2016")
testdataset <- Predict_Dataset
head(testdataset)   # Show Top 6 records
nrow(testdataset)   # Show number of records
names(testdataset)  # Show fields names or columns


#Whether a variable is categorical or ordinal is to be checked and used in the Model
options(digits = 4)
testdataset$FatherOccup <- as.numeric(factor(testdataset$FatherOccup, levels = c('Government Employee','Private employee','Businessman','Senior Executive Manager (J&K Bank)','Bank Clerk','Animal Husbandary','Orphan','SO')))
testdataset$MotherOccup <- as.numeric(factor(testdataset$MotherOccup, levels = c('House wife','Government employee','Private employee','House Maid','Businesswoman','Accountant MIER','Head Master')))
testdataset$Board_10 <- as.numeric(factor(testdataset$Board_10, levels = c('CBSE','J & K','Maharashtra','CISCE','Punjab','Meghalaya','Other')))
testdataset$Marks_Grade_10 <- as.numeric(testdataset$Marks_Grade_10)
testdataset$Board_12 <- as.numeric(factor(testdataset$Board_12, levels = c('CBSE','J & K','Karnataka','National Open School','Other')))
testdataset$Marks_Grade_12 <- as.numeric(testdataset$Marks_Grade_12)
testdataset$Entrance_Score <- as.numeric(testdataset$Entrance_Score)
testdataset$Batch <- factor(testdataset$Batch)
testdataset$Dept <- as.numeric(factor(testdataset$Dept, levels = c('CSE','MBA','MCA','EE','IT','ECE','CIVIL')))
testdataset$SkillIndex <- as.numeric(testdataset$SkillIndex)
testdataset$Placed <- factor(testdataset$Placed, levels = c('Y','N'))
testdataset[is.na(testdataset)] <-0 #all na values are taken as zero


# Data Normalization

testdataset.normal <- normalize(testdataset, cols)
cat("\nNormalized data frame:\n")
print(testdataset.normal, digits=3)


#--------------------------------------------------------------
# Step 8: Sampling by k-fold cross validation
#--------------------------------------------------------------
#LINK- https://machinelearningmastery.com/how-to-estimate-model-accuracy-in-r-using-the-caret-package/

cat("\nStep 8: Sampling by k-fold cross validation")


# define training control
train_control <- trainControl(method = "cv", number = 5)

#--------------------------------------------------------------
# Step 9: Model Building (Training)
#--------------------------------------------------------------
cat("\nStep 9: Model Building -> ", modelName)
formula <- as.formula(paste(target,"~",paste(Factors, collapse = "+")))
formula

model   <- train(formula, data=dataset.normal,trControl=train_control,method = "rf", importance=TRUE)
model

# make predictions
predictions<- predict(model,testdataset)
predictions
head(predictions)
confusionMatrix(predictions,testdataset$Placed)
#prediction probability

PredictedProb <- predict(model, testdataset, type="prob")[,1]
head(PredictedProb)

# append predictions
Predict_Dataset<- cbind(Predict_Dataset,predictions,PredictedProb)
Predict_Dataset

#--------------------------------------------------------------
# Step 10: Updating table in mysql database
#--------------------------------------------------------------

dbWriteTable(con,"batch_2014_2016",Predict_Dataset,row.names=FALSE,append = F , overwrite = T)

#--------------------------------------------------------------
# Step 11: Disconnecting from mysql
#--------------------------------------------------------------
dbDisconnect(con)

