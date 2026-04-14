# Convenciones y Glosario

- Glosario de abreviaturas (MA, A, estatus de beca, roles)

## Activo Alumno (activo)

- **0 → Candidato**: Estudiante que ha mostrado interés en el modelo dual, pero aún no está inscrito.
- **1 → Dual**: Estudiante formalmente inscrito y activo en el modelo de educación dual.
## Inactivo Alumno (activo)

-**delete_at**: Define si el alumno está inactivo (soft delete funcional)

## Estatus de Alumno (status)

- **0 → Primera vez**: Alumno inscrito por primera vez en el modelo dual.
- **1 → Renovación Dual**: Alumno que renueva su participación en el modelo dual.
- **2 → Reprobación**: Alumno que no cumple requisitos académicos.
- **3 → Término de Convenio**: Finalización del acuerdo con la empresa.
- **4 → Ciclo de Renovación Concluido**: Se terminó el periodo de renovación.
- **5 → Término del PE**: Finalización del Programa Educativo.

## Situaciones Académicas (Roles comunes)

- **0 → Primera vez**: Alumno inscrito por primera vez en el modelo dual.
- **1 → Renovación Dual**: Alumno que renueva su participación en el modelo dual.

## Estatus de Beca (beca)

- **0 → Sí**: El estudiante cuenta con beca activa.
- **1 → No**: El estudiante no tiene beca asignada.

## Tipos de Beca (tipoBeca)

- **Null → Sin beca**: No participa en ninguna beca.
- **0 → Apoyo por Empresa**: La empresa otorga apoyo económico directamente.
- **1 → Beca Dual Comecyt**: Apoyo institucional gestionado por Comecyt.
