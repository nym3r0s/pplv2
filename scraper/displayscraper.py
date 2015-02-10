from bs4 import BeautifulSoup
import urllib
import MySQLdb

# MySQL Connection Starts
db = MySQLdb.connect(
host = "localhost",
user = "root",
passwd = "stein238",
db = "ppl"
)
cur = db.cursor()
# using SQL
# cur.execute(SQLquery as string)

def getPage(url):
    urllib.urlretrieve(url,"test.html")

def find_between(s, first, last ):
    try:
        start = s.index( first ) + len( first )
        end = s.index( last, start )
        return s[start:end]
    except ValueError:
        return ""
# The tag details from batting table.

        #<th scope="col" class="th-r" title="runs scored">R</th>
        #<th scope="col" class="th-m" title="minutes batted">M</th>
        #<th scope="col" class="th-b" title="balls faced">B</th>
        #<th scope="col" class="th-4s" title="boundary fours">4s</th>
        #<th scope="col" class="th-6s" title="boundary sixes">6s</th>
        #<th scope="col" class="th-sr" title="batting strike rate: runs scored per 100 balls faced">SR</th>

# The tag details from bowling table

        #<th scope="col" class="th-o" title="overs bowled"><b>O</b></td>
        #<th scope="col" class="th-m" title="maidens bowled"><b>M</b></td>
        #<th scope="col" class="th-r" title="runs conceded"><b>R</b></td>
        #<th scope="col" class="th-w" title="wickets taken"><b>W</b></td>
        #<th scope="col" class="th-econ" title="economy rates of runs conceded per 6 balls bowled"><b>Econ</b></td>
        #<th scope="col" class="th-w" title="dot balls bowled"><b>0s</b></td>
        #<th scope="col" class="th-w" title="boundary fours conceded"><b>4s</b></td>
        #<th scope="col" class="th-w" title="boundary sixes conceded"><b>6s</b></td>

def parse():
    soup = BeautifulSoup(open("test.html"))
    #print soup.prettify()

    # Finding the Batting Tables

    battingTables = soup.find_all("table",class_="batting-table")

    #print battingTables
    print "The Batting Details"
    for table in battingTables:
        tableRows = table.select("tr")
        for info in tableRows:
            if(not("class" in info.attrs.keys())):
                #print info
                #print info.select('td')[1].select('a')[0].contents[0]
                playerName = info.select('td')[1].select('a')[0].contents[0]
                #print info.select('td')[2].contents[0].split(" ")[-3]
                playerWicketBowler= info.select('td')[2].contents[0].replace(u'\u2020',' ').encode('utf-8')

        #playerWicketBowler =  find_between( playerWicketBowler, "c ", " b" )
        #print info.select('td')[3].contents[0]
                playerRuns =  info.select('td')[3].contents[0]
                #print info.select('td')[6].contents[0]
                playerFour = info.select('td')[6].contents[0]
                #print info.select('td')[7].contents[0]
                playerSix =  info.select('td')[7].contents[0]
                #print info.select('td')[8].contents[0]
                playerStrikeRate = info.select('td')[8].contents[0]
                a = []
                a.append(playerName)
                a.append(playerWicketBowler)
                a.append(playerRuns)
                a.append(playerFour)
                a.append(playerSix)
                a.append(playerStrikeRate)
                # Creating SQL Query
                battingInsertQuery = "INSERT INTO displayBatting VALUES ('"+ "','".join(a) + "');"
                print battingInsertQuery
                cur.execute(battingInsertQuery)
                db.commit()

   #Finding the Bowling Tables

    print "The Bowling Details"
    bowlingTables = soup.find_all("table",class_="bowling-table")

    for table in bowlingTables:
        tableRows = table.select("tr")
        for info in tableRows:
            if(not("class" in info.attrs.keys())):
                #print info
                #print info.select('td')[1].select('a')[0].contents[0]
                playerName = info.select('td')[1].select('a')[0].contents[0]
                #print info.select('td')[2].contents[0]
                playerOvers = info.select('td')[2].contents[0]
                #print info.select('td')[3].contents[0]
                playerMaidens = info.select('td')[3].contents[0]
                #print info.select('td')[5].contents[0]
                playerWickets = info.select('td')[5].contents[0]
                #print info.select('td')[6].contents[0]
                playerEcon = info.select('td')[6].contents[0]
                a = []
                a.append(playerName)
                a.append(playerOvers)
                a.append(playerMaidens)
                a.append(playerWickets)
                a.append(playerEcon)
                bowlingInsertQuery= "INSERT INTO displayBowling VALUES ('"+ "','".join(a) + "');"
                print bowlingInsertQuery
                cur.execute(bowlingInsertQuery)
                db.commit()

if(__name__ == "__main__"):
    #getPage("http://www.espncricinfo.com/carlton-mid-triangular-series-2015/engine/match/754761.html")
    cur.execute('TRUNCATE TABLE displayBatting')
    cur.execute('TRUNCATE TABLE displayBowling')
    db.commit()
    getPage("http://www.espncricinfo.com/new-zealand-v-pakistan-2014-15/engine/match/749797.html")
    parse()
