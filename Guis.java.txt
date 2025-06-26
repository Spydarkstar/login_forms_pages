package basic;

import java.io.BufferedReader ;
import java.io.IOException ;
import java.io.InputStreamReader ;
import javax.swing.JOptionPane ;


public class Guis {
	public static void main(String[] args) {
		String firstname = JOptionPane.showInputDialog (null , " First name :");
		String lastname = JOptionPane.showInputDialog (null , " First name :");
		JOptionPane.showMessageDialog(null , lastname + ", " + firstname ) ;
	}
}
