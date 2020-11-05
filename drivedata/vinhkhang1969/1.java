import java.util.*;

public class Ex05
{
  public static void main(String[] args)
  {
    System.out.println("Enter digits: ");
    Scanner sc = new Scanner(System.in);
    long n = sc.nextLong();

    System.out.println("\nNumber of digits  = "+CountDigit(n));
  }

  public static int CountDigit(long n) 
  { 
    int count = 0; 
    while (n != 0) 
    { 
      n /= 10; 
      ++count; 
    } 
    return count; 
  } 

}