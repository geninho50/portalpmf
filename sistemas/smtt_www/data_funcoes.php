<?php
function dia_da_semana($nds)
{
	if ($nds == 1)
	{
		$ddsemana = 'segunda';
	}
	if ($nds == 2)
	{
		$ddsemana = 'terça';
	}
	if ($nds == 3)
	{
		$ddsemana = 'quarta';
	}
	if ($nds == 4)
	{
		$ddsemana = 'quinta';
	}
	if ($nds == 5)
	{
		$ddsemana = 'sexta';
	}
	if ($nds == 6)
	{
		$ddsemana = 'sábado';
	}
	if ($nds == 7)
	{
		$ddsemana = 'domingo';
	}
	return $ddsemana;
}
?>