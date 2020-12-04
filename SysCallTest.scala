import scala.sys.process._
import scala.language.postfixOps._

object SysCallTest{
  def main (args: Array[String]): Unit={
    val dirContents= "./njvm --help".!!
    println(dirContents)
  }
}
