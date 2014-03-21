using System.Windows.Controls;

namespace HmiLike
{
  	public static class Switcher
  	{
        public static MainWindow pageSwitcher;

    	public static void Switch(UserControl newPage)
    	{
      		pageSwitcher.Navigate(newPage);
    	}    	
  	}
}
